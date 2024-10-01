<?php

namespace App\Livewire\Hutang;

use App\Models\EggTransTemp;
use App\Models\Hutang;
use App\Models\User;
use Livewire\Component;

class DebtDetail extends Component
{
    public $userid;
    public $name;
    public $address;
    public $items;
    public $dataTrx;

    public function mount($userid)
    {
        $this->userid = $userid;
        $this->getDataUser($userid);
    }

    public function render()
    {
        $this->getItems();
        return view('livewire.hutang.debt-detail', [
            'items' => $this->items
        ]);
    }

    public function getDataUser($id)
    {
        $user = User::findOrFail($id);
        $this->name = $user->name ?? '-';
        $this->address = $user->address ?? '-';
    }

    public function getItems()
    {
        $this->items = Hutang::where('supplier', $this->userid)->get();
    }

    public function modalDetail($id)
    {
        $this->dataTrx = EggTransTemp::join('medicines', 'medicines.id', '=', 'egg_trans_temps.egg_id')
        ->where('egg_trans_temps.trx_id', $id)
        ->select('trx_id', 'medicines.name', 'medicines.code', 'qty', 'egg_trans_temps.price', 'total')
        ->get();;
        $this->dispatch('modalDetail');
    }
}
