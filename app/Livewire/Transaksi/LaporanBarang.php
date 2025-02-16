<?php

namespace App\Livewire\Transaksi;

use App\Models\EggTransTemp;
use App\Models\EggTrx;
use Livewire\Component;

class LaporanBarang extends Component
{
    public $items;
    public $bulan;
    public $key;
    public $jenis;
    public $code;

    public function render()
    {
        return view('livewire.transaksi.laporan-barang');
    }

    public function getItems()
    {
        $query = EggTransTemp::leftJoin('egg_trxes', 'egg_trxes.idtransaksi', '=', 'egg_trans_temps.trx_id')
                ->join('medicines', 'medicines.id', '=', 'egg_trans_temps.egg_id')
                ->join('users', 'users.id', '=', 'egg_trxes.costumer_id')
                ->where('egg_trxes.tipetrx', 'pakan')
                ->where('egg_trans_temps.price', '!=', 1);

        if ($this->bulan) {
            list($year, $month) = explode('-', $this->bulan);
            
            $query->whereMonth('egg_trans_temps.created_at', $month)
                    ->whereYear('egg_trans_temps.created_at', $year);
        }

        if ($this->jenis) {
            $query->where('egg_trxes.trxtipe', $this->jenis);
        }

        if ($this->code) {
            $query->where('medicines.code', $this->code);
        }

        $this->items = $query->select(
            'egg_trans_temps.*',
            'medicines.code',
            'medicines.name',
            'egg_trxes.trxtipe',
            'egg_trxes.payment_status',
            'egg_trxes.disc',
            'egg_trxes.totalprice'
        )->get();

    }

    public function loadReport()
    {
        $this->getItems();
    }
}
