<?php

namespace App\Livewire\Egg;

use App\Models\EggTransTemp;
use Livewire\Component;
use Carbon\Carbon;

class TelurMasuk extends Component
{
    public $tanggal;
    public $items;

    public function mount()
    {
        $this->tanggal = now()->format('Y-m-d');
    }

    public function render()
    {
        $this->getItems();
        return view('livewire.egg.telur-masuk');
    }

    public function getItems()
    {
        $this->items = EggTransTemp::join('egg_trxes', 'egg_trxes.idtransaksi', '=', 'egg_trans_temps.trx_id')
                    ->join('users', 'users.id', '=', 'egg_trxes.costumer_id')
                    ->join('eggs', 'eggs.id', '=', 'egg_trans_temps.egg_id')
                    ->where('trxtipe', 'pembelian')->where('tipetrx', 'egg')
                    ->select('egg_trxes.keterangan', 'users.name', 'qty', 'users.id as userid', 'eggs.id as egg_id', 'eggs.name as telur')
                    ->get();
    }
}
