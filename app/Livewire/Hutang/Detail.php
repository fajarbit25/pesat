<?php

namespace App\Livewire\Hutang;

use App\Models\Egg;
use App\Models\EggMutasi;
use App\Models\EggTransTemp;
use App\Models\EggTrx;
use App\Models\Hutang;
use App\Models\HutangPlasma;
use App\Models\Medicine;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Detail extends Component
{
    protected $listeners = ['deletingEgg' => 'destroyTelur', 'deletingProduk' => 'destroyProduk'];
    public $userid;
    private $items;
    private $produk;
    public $dataTrx;
    public $month;

    public $idDeleteTelur;
    public $idDeleteProduct;
    public $totalHutang;
    public $endDate;
    public $starDate;

    public function mount($userid)
    {
        $this->userid = $userid;
        $this->month = date('Y-m');
    }

    public function render()
    {
        $user = User::findOrFail($this->userid);

        $this->getItems();
        $this->getProduk();
        return view('livewire.hutang.detail', [
            'items'    => $this->items,
            'produk'   => $this->produk,
            'name'     => $user->name,
            'address'  => $user->address,
        ]);
    }

    public function getItems()
    {
        $startDate = $this->month . '-01'; // Start of the month
        $endDate = date('Y-m-t', strtotime($startDate)); // End of the month
        $this->starDate = $startDate;
        $this->endDate = $endDate;

        $this->items = EggTrx::leftJoin('egg_trans_temps', 'egg_trans_temps.trx_id', '=', 'egg_trxes.idtransaksi')
                        ->join('eggs', 'eggs.id', '=', 'egg_trans_temps.egg_id')
                        ->where('costumer_id', $this->userid)
                        ->where('trxtipe', 'pembelian')->where('tipetrx', 'egg')
                        ->whereBetween('egg_trans_temps.created_at', [$this->starDate, $this->endDate])
                        ->select('egg_trxes.*', 'eggs.name', 'egg_trans_temps.created_at as tanggal', 'egg_trans_temps.qty',
                        'egg_trans_temps.price', 'egg_trans_temps.total')->orderBy('egg_trans_temps.created_at', 'ASC')->get();
    }

    public function getProduk()
    {

        $this->produk = EggTrx::leftJoin('egg_trans_temps', 'egg_trans_temps.trx_id', '=', 'egg_trxes.idtransaksi')
                        ->join('medicines', 'medicines.id', '=', 'egg_trans_temps.egg_id')
                        ->where('costumer_id', $this->userid)
                        ->where('trxtipe', 'penjualan')->where('tipetrx', '!=', 'egg')
                        ->whereBetween('egg_trans_temps.created_at', [$this->starDate, $this->endDate])
                        ->select('egg_trxes.*', 'medicines.name', 'egg_trans_temps.created_at as tanggal', 'egg_trans_temps.qty',
                        'egg_trans_temps.price', 'egg_trans_temps.total')->orderBy('egg_trans_temps.created_at', 'ASC')->get();
    }

    public function modalDetailEgg($id)
    {
        $this->dataTrx = EggTransTemp::join('eggs', 'eggs.id', '=', 'egg_trans_temps.egg_id')
                                ->where('egg_trans_temps.trx_id', $id)
                                ->select('trx_id', 'eggs.name', 'eggs.code', 'qty', 'price', 'total')
                                ->get();
        $this->dispatch('modalDetail');
    }

    public function modalDetail($id)
    {
        $this->dataTrx = EggTransTemp::join('medicines', 'medicines.id', '=', 'egg_trans_temps.egg_id')
                                ->where('egg_trans_temps.trx_id', $id)
                                ->select('trx_id', 'medicines.name', 'medicines.code', 'egg_trans_temps.qty', 'egg_trans_temps.price', 'total')
                                ->get();
        $this->dispatch('modalDetail');
    }

    public function confirmDeleteTelur($id)
    {
        $this->idDeleteTelur = $id;
        $this->dispatch('confirmDeleteTelur');
    }

    public function destroyTelur()
    {
        $data = EggTransTemp::join('eggs', 'eggs.id', '=', 'egg_trans_temps.egg_id')
                ->where('egg_trans_temps.trx_id', $this->idDeleteTelur)
                ->select('trx_id', 'eggs.name', 'eggs.code', 'qty', 'price', 'total', 'egg_id')
                ->first();
        $idTelur = $data->egg_id;
        $qty = $data->qty;
        $totalTrx = $data->total;

        try {

            //update Trx
            $trx = EggTrx::where('idtransaksi', $this->idDeleteTelur)->first();
            $trxTotalAwal = $trx->totalprice;
            $userid = $trx->costumer_id;
            EggTrx::where('idtransaksi', $this->idDeleteTelur)->update([
                'totalprice'    => $trxTotalAwal-$totalTrx,
            ]);

            //update stock;
            $telur = Egg::findOrFail($idTelur);
            $stockAwal = $telur->stock;
            $telur->update([
                'stock' => $telur->stock-$qty,
            ]);


            //insert Mutasi telur
            EggMutasi::create([
                'egg_id'        => $idTelur,
                'supplier_id'   => Auth::user()->id, 
                'qty'           => -$qty,
                'stockawal'     => $stockAwal,
                'atockakhir'    => $stockAwal-$qty,
                'date'          => date('Y-m-d'),
                'user_id'       => Auth::user()->id,
            ]);

            //upate hutang costumer
            $hutangPlasma = HutangPlasma::where('user_id', $userid)->first();
            $hutang = HutangPlasma::findOrFail($hutangPlasma->id);
            $hutang->update([
                'hutang'    => $hutangPlasma->hutang-$totalTrx,
            ]);

            //delete transtemp
            EggTransTemp::where('trx_id', $this->idDeleteTelur)->delete();

            $this->reset('idDeleteTelur');

            $this->dispatch('alert', [
                'title'     => 'Warning',
                'message'   => 'Transaksi dihapus',
                'icon'      => 'warning',
            ]);


        } catch (Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Terjadi kesalahan',
                'icon'      => 'error',
                'error'     => $e->getMessage(),
            ]);
        }


    }

    public function confirmDeleteProduk($id)
    {
        $this->idDeleteProduct = $id;
        $this->dispatch('confirmDeleteProduk');
    }

    public function destroyProduk()
    {
        $data = EggTransTemp::join('medicines', 'medicines.id', '=', 'egg_trans_temps.egg_id')
                ->where('egg_trans_temps.trx_id', $this->idDeleteProduct)
                ->select('trx_id', 'medicines.name', 'medicines.code', 'qty', 'egg_trans_temps.price', 'total', 'egg_id')
                ->first();
        $idProduk = $data->egg_id;
        $qty = $data->qty;
        $totalTrx = $data->total;

        try {

            //update Trx
            $trx = EggTrx::where('idtransaksi', $this->idDeleteProduct)->first();
            $trxTotalAwal = $trx->totalprice;
            $userid = $trx->costumer_id;
            EggTrx::where('idtransaksi', $this->idDeleteProduct)->update([
                'totalprice'    => $trxTotalAwal-$totalTrx,
            ]);

            //update stock;
            $telur = Medicine::findOrFail($idProduk);
            $stockAwal = $telur->stock;
            $telur->update([
                'stock' => $telur->stock-$qty,
            ]);


            //insert Mutasi produk
            EggMutasi::create([
                'egg_id'        => $idProduk,
                'supplier_id'   => Auth::user()->id, 
                'qty'           => -$qty,
                'stockawal'     => $stockAwal,
                'atockakhir'    => $stockAwal-$qty,
                'date'          => date('Y-m-d'),
                'user_id'       => Auth::user()->id,
            ]);

            //upate hutang costumer
            $hutangPlasma = HutangPlasma::where('user_id', $userid)->first();
            $hutang = HutangPlasma::findOrFail($hutangPlasma->id);
            $hutang->update([
                'hutang'    => $hutangPlasma->hutang-$totalTrx,
            ]);

            //delete transtemp
            EggTransTemp::where('trx_id', $this->idDeleteProduct)->delete();

            $this->reset('idDeleteProduct');

            $this->dispatch('alert', [
                'title'     => 'Warning',
                'message'   => 'Transaksi dihapus',
                'icon'      => 'warning',
            ]);


        } catch (Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Terjadi kesalahan',
                'icon'      => 'error',
                'error'     => $e->getMessage(),
            ]);
        }


    }
}
