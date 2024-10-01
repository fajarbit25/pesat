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
    public $dataTrx;

    public function mount($userid)
    {
        $this->userid = $userid;
    }

    public function render()
    {
        $user = User::findOrFail($this->userid);

        $this->getItems();
        return view('livewire.hutang.detail', [
            'items'    => $this->items,
            'name'     => $user->name,
            'address'  => $user->address,
        ]);
    }

    public function getItems()
    {
        $this->items = EggTrx::where('costumer_id', $this->userid)
                        ->orderBy('created_at', 'DESC')->paginate(3);
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
