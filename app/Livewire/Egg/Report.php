<?php

namespace App\Livewire\Egg;

use App\Models\EggTransTemp;
use App\Models\EggTrx;
use Livewire\Component;
use Livewire\WithPagination;

class Report extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $start;
    public $end;
    private $items;
    public $dataTrx;

    public function mount()
    {
        $this->start = date('Y-m').'-01';
        $this->end = date('Y-m').'-30';
    }

    public function render()
    {
        $this->getData();
        return view('livewire.egg.report', [
            'items'     => $this->items
        ]);
    }

    public function modalFilter()
    {
        $this->dispatch('modalFilter');
    }

    public function cari()
    {
        $this->getData();
        $this->dispatch('closeModal');
    }

    public function getData()
    {
        $this->items = EggTrx::join('users', 'users.id', '=', 'egg_trxes.costumer_id')
                        ->whereBetween('egg_trxes.created_at', [$this->start, $this->end])
                        ->select('egg_trxes.id', 'users.name', 'idtransaksi', 'trxtipe', 'totalprice', 'egg_trxes.created_at')
                        ->orderBy('egg_trxes.id', 'DESC')->paginate(10);
    }

    public function modalDetail($id)
    {
        $this->dataTrx = EggTransTemp::join('eggs', 'eggs.id', '=', 'egg_trans_temps.egg_id')
                                ->where('egg_trans_temps.trx_id', $id)
                                ->select('trx_id', 'eggs.name', 'eggs.code', 'qty', 'price', 'total')
                                ->get();
        $this->dispatch('modalDetail');
    }
}
