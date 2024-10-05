<?php

namespace App\Livewire\Hutang;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Buyer extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $items;

    public function render()
    {
        $this->getItems();
        return view('livewire.hutang.buyer', [
            'items' => $this->items
        ]);
    }

    public function getItems()
    {
        $this->items = User::join('hutang_plasmas', 'hutang_plasmas.user_id', '=', 'users.id')
                            ->where('users.level', '5')
                            ->select('users.id', 'name', 'address', 'hutang')
                            ->paginate(10);
    }
}
