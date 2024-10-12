<?php

namespace App\Livewire\Egg;

use App\Models\Egg;
use App\Models\EggMutasi;
use App\Models\EggTransTemp;
use Livewire\Component;
use Carbon\Carbon;

class TelurMasuk extends Component
{
    public $tanggal;
    public $items;
    public $stockAwal;
    public $stockOut;

    public function mount()
    {
        $this->tanggal = now()->toDateString();
    }

    public function render()
    {
        $this->getItems();
        $this->getStock();
        $this->telurKeluar();
        return view('livewire.egg.telur-masuk');
    }

    public function getItems()
    {
        $this->items = EggTransTemp::join('egg_trxes', 'egg_trxes.idtransaksi', '=', 'egg_trans_temps.trx_id')
                    ->join('users', 'users.id', '=', 'egg_trxes.costumer_id')
                    ->join('eggs', 'eggs.id', '=', 'egg_trans_temps.egg_id')
                    ->where('trxtipe', 'pembelian')->where('tipetrx', 'egg')
                    ->where('eggs.id', '!=', '3')
                    ->whereDate('egg_trans_temps.created_at', $this->tanggal)
                    ->select('egg_trxes.keterangan', 'users.name', 'qty', 'users.id as userid', 'eggs.id as egg_id', 'eggs.name as telur')
                    ->get();
    }
     
    public function getStock()
    {
        $besar =  EggMutasi::where('egg_id', '1')
        ->whereDate('date', $this->tanggal)
        ->orderByDesc('id')
        ->select('atockakhir')
        ->first();

        $kecil = EggMutasi::where('egg_id', '2')
        ->whereDate('date', $this->tanggal)
        ->orderByDesc('id')
        ->select('atockakhir')
        ->first();

        $stockBesar = $besar->atockakhir ?? 0;
        $stockKecil = $kecil->atockakhir ?? 0;

        $this->stockAwal = $stockBesar+$stockKecil;
    }

    public function telurKeluar()
    {
        $this->stockOut = EggTransTemp::join('egg_trxes', 'egg_trxes.idtransaksi', '=', 'egg_trans_temps.trx_id')
                    ->where('trxtipe', 'penjualan')->where('tipetrx', 'egg')
                    ->join('eggs', 'eggs.id', '=', 'egg_trans_temps.egg_id')
                    ->where('eggs.id', '!=', '3')
                    ->whereDate('egg_trans_temps.created_at', $this->tanggal)
                    ->sum('qty');
    }

}
