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
    public $discTelur;
    public $discProduk;


    public function mount($userid)
    {
        $this->userid = $userid;
        $this->month = date('Y-m');
    }

    public function render()
    {
        $user = User::findOrFail($this->userid);

        $this->getTotalHutang();
        $this->getItems();
        $this->getProduk();
        $this->getDisc();
        return view('livewire.hutang.detail', [
            'items'    => $this->items,
            'produk'   => $this->produk,
            'name'     => $user->name,
            'address'  => $user->address,
        ]);
    }

    public function getTotalHutang()
    {
        $this->totalHutang = HutangPlasma::where('user_id', $this->userid)->sum('hutang') ?? 0;
    }

    public function getItems()
    {
        $month = substr($this->month, 5, 2);

        $this->items = EggTrx::leftJoin('egg_trans_temps', 'egg_trans_temps.trx_id', '=', 'egg_trxes.idtransaksi')
                        ->join('eggs', 'eggs.id', '=', 'egg_trans_temps.egg_id')
                        ->where('costumer_id', $this->userid)
                        ->where('trxtipe', 'pembelian')->where('tipetrx', 'egg')
                        ->whereMonth('egg_trans_temps.created_at', $month)
                        ->select('egg_trxes.*', 'eggs.id as idbarang', 'eggs.name', 'egg_trans_temps.created_at as tanggal', 'egg_trans_temps.qty',
                        'egg_trans_temps.price', 'egg_trans_temps.total', 'disc')->orderBy('egg_trans_temps.created_at', 'ASC')->get();
    }

    public function getProduk()
    {
        $month = substr($this->month, 5, 2);

        $this->produk = EggTrx::leftJoin('egg_trans_temps', 'egg_trans_temps.trx_id', '=', 'egg_trxes.idtransaksi')
                        ->join('medicines', 'medicines.id', '=', 'egg_trans_temps.egg_id')
                        ->where('costumer_id', $this->userid)
                        ->where('trxtipe', 'penjualan')->where('tipetrx', '!=', 'egg')
                        ->where('egg_trans_temps.egg_id', '!=', '120')
                        ->whereMonth('egg_trans_temps.created_at', $month)
                        ->select('egg_trxes.*', 'medicines.id as idbarang', 'medicines.name', 'egg_trans_temps.created_at as tanggal', 'egg_trans_temps.qty',
                        'egg_trans_temps.price', 'egg_trans_temps.total', 'disc', 'egg_trans_temps.id as idtrx')
                        ->orderBy('egg_trans_temps.created_at', 'ASC')->get();
    }

    public function modalDetailEgg($id)
    {
        $this->dataTrx = EggTransTemp::join('eggs', 'eggs.id', '=', 'egg_trans_temps.egg_id')
                                ->where('egg_trans_temps.trx_id', $id)
                                ->select('trx_id', 'eggs.name', 'eggs.code', 'qty', 'price', 'total')
                                ->get();
        $this->dispatch('modalDetail');
    }

    public function getDisc()
    {
        $month = substr($this->month, 5, 2);
        $this->discTelur = EggTrx::whereMonth('created_at', $month)
                    ->where('costumer_id', $this->userid)
                    ->where('tipetrx', 'egg')
                    ->sum('disc') ?? 0;
        
        $this->discProduk = EggTrx::whereMonth('created_at', $month)
                    ->where('costumer_id', $this->userid)
                    ->where('tipetrx', 'pakan')
                    ->sum('disc') ?? 0;
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
            $trx = EggTrx::where('idtransaksi', $this->idDeleteTelur)->get();
            $trxTotalAwal = $trx->sum('totalprice');
            $userid = $trx->first()->costumer_id;
            $disc = $trx->sum('disc');
            // $newTotalPrice = $trxTotalAwal-$totalTrx;

            // EggTrx::where('idtransaksi', $this->idDeleteTelur)->update([
            //     'totalprice'    => $newTotalPrice,
            // ]);

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
            $penambahanhutang = $trxTotalAwal;
            $hutangPlasma = HutangPlasma::where('user_id', $userid)->first();

            $hutang = HutangPlasma::findOrFail($hutangPlasma->id);
            $hutang->update([
                'hutang'    => $hutangPlasma->hutang+$penambahanhutang,
            ]);

            //delete transtemp
            EggTransTemp::where('trx_id', $this->idDeleteTelur)->delete();
            EggTrx::where('idtransaksi', $this->idDeleteTelur)->delete();

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

        try {

            $data = EggTransTemp::find($this->idDeleteProduct);

            //update Trx
            $trx = EggTrx::where('idtransaksi', $data->trx_id)->first();
            $trxTotalAwal = $trx->totalprice; //ambil total price
            $userid = $trx->costumer_id; // ambil costumer id

            //update harga total proce
            EggTrx::where('idtransaksi', $this->idDeleteProduct)->update([
                'totalprice'    => $trxTotalAwal - $data->total,
            ]);

            //update stock;
            $produk = Medicine::find($data->egg_id);
            $stockAwal = $produk->stock;

            Medicine::where('id', $produk->id)
            ->update([
                'stock' => $stockAwal + $data->qty,
            ]);

            //insert Mutasi produk
            EggMutasi::create([
                'egg_id'        => $produk->id,
                'supplier_id'   => Auth::user()->id, 
                'qty'           => -$data->qty,
                'stockawal'     => $stockAwal,
                'atockakhir'    => $stockAwal+$data->qty,
                'date'          => date('Y-m-d'),
                'user_id'       => Auth::user()->id,
            ]);

            //upate hutang costumer
            $hutangPlasma = HutangPlasma::where('user_id', $userid)->first();
            $hutang = HutangPlasma::findOrFail($hutangPlasma->id);
            $hutang->update([
                'hutang'    => $hutangPlasma->hutang-$data->total,
            ]);

            //delete transtemp
            EggTransTemp::where('id', $data->id)->delete();

            $this->reset('idDeleteProduct');

            $this->dispatch('alert', [
                'title'     => 'Warning',
                'message'   => 'Transaksi dihapus',
                'icon'      => 'warning',
            ]);


        } catch (\Exception $e) {

            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Terjadi kesalahan',
                'icon'      => 'error',
                'error'     => $e->getMessage(),
            ]);

        }


    }

    
}
