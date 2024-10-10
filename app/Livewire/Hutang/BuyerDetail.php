<?php

namespace App\Livewire\Hutang;

use App\Models\EggTransTemp;
use App\Models\EggTrx;
use App\Models\HutangPlasma;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BuyerDetail extends Component
{
    public $userid;
    private $items;
    private $users;
    public $month;

    public $idBayar;
    public $totalBayar;
    public $pay;

    public function mount($userid)
    {
        $this->userid = $userid;
        $this->month = date('Y M');
    }

    public function render()
    {
        $this->getItems();
        $this->getUsers();
        return view('livewire.hutang.buyer-detail', [
            'items'     => $this->items,
            'users'     => $this->users,
        ]);
    }

    public function getItems()
    {
        $month = date('m', strtotime($this->month));
        $this->items = EggTrx::join('egg_trans_temps', 'egg_trans_temps.trx_id', '=', 'egg_trxes.idtransaksi')
                            ->join('eggs', 'eggs.id', '=', 'egg_trans_temps.egg_id')
                            ->where('costumer_id', $this->userid)->where('egg_trxes.tipetrx', 'egg')->where('egg_trxes.trxtipe', 'penjualan')
                            ->whereMonth('egg_trxes.created_at', $month) // Filter berdasarkan bulan
                            ->select('egg_trxes.*', 'eggs.name', 'egg_trans_temps.qty', 'egg_trans_temps.price', 'egg_trans_temps.total',
                            'egg_trxes.created_at as tanggal', 'idtansaksi', 'payment_status', 'keterangan', 'totalprice')
                            ->get();
    }

    public function getUsers()
    {
        $this->users = User::join('user_levels', 'user_levels.id', '=', 'users.level')
                            ->where('users.id', $this->userid)
                            ->select('name', 'address', 'user_levels.level', 'user_levels.divisi', 'phone')
                            ->first();
    }

    public function modalBayar($id)
    {
        $this->idBayar = $id;
        $trx = EggTrx::where('idtransaksi', $this->idBayar)->first();
        $this->totalBayar = $trx->totalprice ?? 0;
        $this->dispatch('modalBayar');
    }

    public function prosesBayar()
    {
        $trx = EggTrx::where('idtransaksi', $this->idBayar)->first(); //get data transaksi
        $user = User::findOrFail($trx->costumer_id); //get data user
        $hutang = HutangPlasma::where('user_id', $user->id)->first(); //get hutang plasma
        $totalHutangPlasma = $hutang->hutang ?? 0; //ambil data hutang

        $keterangan = $trx->keterangan ?? '';
        $deskripsi = $keterangan.',<br/><br/> Term : [Telah terbayar sebesar Rp.'.number_format($this->pay).',- oleh '.$user->name.', Tanggal '.date('d M Y').']';

        try {

            if ($trx->totalprice == $this->pay) {
                //bayar total

                $trxTempTotal = EggTransTemp::where('trx_id', $this->idBayar)->sum('total') ?? 0;

                //update data transaksi
                EggTrx::where('idtransaksi', $this->idBayar)->update([
                    'keterangan'        => $deskripsi,
                    'payment_status'    => 'lunas',
                    'totalprice'        => $trxTempTotal,
                ]); 

                //update data hutang
                HutangPlasma::where('user_id', $user->id)->update([
                    'hutang'    => $totalHutangPlasma-$this->pay,
                ]);

                $this->reset('pay', 'idBayar', 'totalBayar');
                $this->dispatch('closeModal');

            } elseif ($trx->totalprice > $this->pay) {
                //bayar setengah

                //update data transaksi
                EggTrx::where('idtransaksi', $this->idBayar)->update([
                    'keterangan'        => $deskripsi,
                    'totalprice'        => $this->totalBayar-$this->pay,
                ]); 

                //update data hutang
                HutangPlasma::where('user_id', $user->id)->update([
                    'hutang'    => $totalHutangPlasma-$this->pay,
                ]);

                $this->reset('pay', 'idBayar', 'totalBayar');
                $this->dispatch('closeModal');
            } else {
                //error pembayaran lebih
                $this->dispatch('alert', [
                    'title'     => 'Oops',
                    'message'   => 'Jumlah uang yang diinput melebihi total hutang!',
                    'icon'      => 'error',
                ]);
            }
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
