<?php

namespace App\Livewire\Hutang;

use App\Models\EggPrice;
use Livewire\Component;
use Livewire\WithPagination;

class HargaTelur extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $userid;
    public $effectid;
    public $big;
    public $small;
    public $borken;

    public $level ='3';
    public $key;

    private $items;

    public function render()
    {
        $this->getItems();
        return view('livewire.hutang.harga-telur', [
            'items' => $this->items,
        ]);
    }

    public function getItems()
    {
        if ($this->key == "") {
            $this->items = EggPrice::join('users', 'users.id', '=', 'egg_prices.user_id')
                ->where('users.level', $this->level)
                ->select('users.id', 'users.name', 'users.address', 'big', 'small', 'broken')->paginate(10);
        } else {
            $this->items = EggPrice::join('users', 'users.id', '=', 'egg_prices.user_id')
                ->where('users.level', $this->level)->where('users.name', 'like', '%'.$this->key.'%')
                ->select('users.id', 'users.name', 'users.address', 'big', 'small', 'broken')->paginate(10);
        }
    }

    public function edit($id)
    {
        $this->userid = $id;
        $this->effectid = $id;
        $data = EggPrice::where('user_id', $this->userid)->first();
        $this->big = $data->big;
        $this->small = $data->small;
    }

    public function saveEdit()
    {
        $this->validate([
            'big'   => 'required',
            'small' => 'required',
        ]);

        try {
            EggPrice::where('user_id', $this->userid)->update([
                'big'   => $this->big,
                'small' => $this->small,
            ]);

            $this->reset('userid', 'big', 'small');
        } catch (\Exception $e) {

            $this->session()->flash('warning', 'Gagal menyimpan data!');

        }
    }
}
