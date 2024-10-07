<?php

namespace App\Livewire\Hutang;

use App\Models\EggTrx;
use App\Models\User;
use Livewire\Component;

class BuyerDetail extends Component
{
    public $userid;
    public $items;
    public $users;

    public function mount($userid)
    {
        $this->userid = $userid;
        $this->getItems();
        $this->getUsers();
    }

    public function render()
    {
        return view('livewire.hutang.buyer-detail');
    }

    public function getItems()
    {
        $this->items = EggTrx::join('egg_trans_temps', 'egg_trans_temps.trx_id', '=', 'egg_trxes.idtransaksi')
                            ->join('eggs', 'eggs.id', '=', 'egg_trans_temps.egg_id')
                            ->where('costumer_id', $this->userid)->where('egg_trxes.tipetrx', 'egg')->where('egg_trxes.trxtipe', 'penjualan')
                            ->select('egg_trxes.*', 'eggs.name', 'egg_trans_temps.qty', 'egg_trans_temps.price', 'egg_trans_temps.total',
                            'egg_trxes.created_at as tanggal', 'idtansaksi', 'payment_status', 'keterangan')
                            ->get();
    }

    public function getUsers()
    {
        $this->users = User::join('user_levels', 'user_levels.id', '=', 'users.level')
                            ->where('users.id', $this->userid)
                            ->select('name', 'address', 'user_levels.level', 'user_levels.divisi', 'phone')
                            ->first();
    }
}
