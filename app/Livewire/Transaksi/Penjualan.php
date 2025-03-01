<?php

namespace App\Livewire\Transaksi;

use App\Models\EggTransTemp;
use App\Models\EggTrx;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Penjualan extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    private $items;
    public $start;
    public $end;

    public function mount()
    {
        // Ambil tanggal hari ini
        $today = Carbon::today();

        // Ambil tanggal terendah (tanggal pertama) di bulan ini
        $firstDayOfMonth = $today->copy()->startOfMonth();

        // Ambil tanggal tertinggi (tanggal terakhir) di bulan ini
        $lastDayOfMonth = $today->copy()->endOfMonth();

        $this->start = $firstDayOfMonth->toDateString();
        $this->end = $lastDayOfMonth->toDateString();
    }

    public function render()
    {
        $this->getItems();
        return view('livewire.transaksi.penjualan', [
            'items'=> $this->items
        ]);
    }

    public function getItems()
    {
        $this->items = EggTransTemp::join('medicines', 'medicines.id', '=', 'egg_trans_temps.egg_id')
                ->join('egg_trxes', 'egg_trxes.idtransaksi', '=', 'egg_trans_temps.trx_id')
                ->join('users', 'users.id', '=', 'egg_trxes.costumer_id')
                ->where('egg_trxes.trxtipe', 'penjualan')
                ->where('status', 'inactive')
                ->where('tipetrx', 'pakan')
                ->where('medicines.name', '!=', 'PELUNASAN')
                ->whereBetween('egg_trxes.created_at', [$this->start, $this->end])
                ->select('trx_id', 'medicines.name', 'medicines.code', 
                    'egg_trans_temps.qty', 'egg_trans_temps.price', 'egg_trans_temps.total',
                    'egg_trxes.created_at', 'users.name as costumer', 'egg_trxes.trxtipe')
                ->paginate(10);

    }

    public function reloadData()
    {
        $this->getItems();
    }
    
    
}
