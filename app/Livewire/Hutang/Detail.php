<?php

namespace App\Livewire\Hutang;

use App\Models\EggTransTemp;
use App\Models\EggTrx;
use App\Models\User;
use Livewire\Component;

class Detail extends Component
{
    public $userid;
    private $items;
    private $produk;
    public $dataTrx;
    public $month;

    public function mount($userid)
    {
        $this->userid = $userid;
        $this->month = date('Y M');
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

        $this->items = EggTrx::leftJoin('egg_trans_temps', 'egg_trans_temps.trx_id', '=', 'egg_trxes.idtransaksi')
                        ->join('eggs', 'eggs.id', '=', 'egg_trans_temps.egg_id')
                        ->where('costumer_id', $this->userid)
                        ->where('trxtipe', 'pembelian')->where('tipetrx', 'egg')
                        ->whereBetween('egg_trxes.created_at', [$startDate, $endDate])
                        ->select('egg_trxes.*', 'eggs.name', 'egg_trans_temps.created_at as tanggal', 'egg_trans_temps.qty',
                        'egg_trans_temps.price', 'egg_trans_temps.total')->get();
    }

    public function getProduk()
    {
        $startDate = $this->month . '-01'; // Start of the month
        $endDate = date('Y-m-t', strtotime($startDate)); // End of the month

        $this->produk = EggTrx::leftJoin('egg_trans_temps', 'egg_trans_temps.trx_id', '=', 'egg_trxes.idtransaksi')
                        ->join('medicines', 'medicines.id', '=', 'egg_trans_temps.egg_id')
                        ->where('costumer_id', $this->userid)
                        ->where('trxtipe', 'penjualan')->where('tipetrx', '!=', 'egg')
                        ->whereBetween('egg_trxes.created_at', [$startDate, $endDate])
                        ->select('egg_trxes.*', 'medicines.name', 'egg_trans_temps.created_at as tanggal', 'egg_trans_temps.qty',
                        'egg_trans_temps.price', 'egg_trans_temps.total')->get();
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
}
