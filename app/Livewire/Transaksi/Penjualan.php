<?php

namespace App\Livewire\Transaksi;

use App\Models\EggTransTemp;
use App\Models\EggTrx;
use Livewire\Component;
use Livewire\WithPagination;

class Penjualan extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    private $items;
    public $dataTrx;

    public function render()
    {
        $this->getItems();
        return view('livewire.transaksi.penjualan', [
            'items'=> $this->items
        ]);
    }

    public function getItems()
    {
        $this->items = EggTrx::join('users', 'users.id', '=', 'egg_trxes.costumer_id')
                    ->where('tipetrx', '!=', 'egg')->where('trxtipe', 'penjualan')
                    ->select('egg_trxes.*', 'users.name')
                    ->orderBy('egg_trxes.created_at', 'DESC')->paginate(10);
    }
    
    public function modalDetail($id)
    {
        $this->dataTrx = EggTransTemp::join('medicines', 'medicines.id', '=', 'egg_trans_temps.egg_id')
                                ->where('egg_trans_temps.trx_id', $id)
                                ->select('trx_id', 'medicines.name', 'medicines.code', 'qty', 'egg_trans_temps.price', 'total')
                                ->get();
        $this->dispatch('modalDetail');
    }
}
