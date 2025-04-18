<?php

namespace App\Livewire\Egg;

use App\Models\Egg;
use App\Models\EggMutasi;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EggChart extends Component
{

    public $chart;
    public $eggid;
    public $name;

    public function mount($id)
    {
        // Mengambil data telur berdasarkan ID
        $egg = Egg::where('code', $id)->first();

       $this->eggid = $egg->id;
       $this->name = $egg->name ?? '';
    }

    public function render()
    {
        // Kueri untuk supplier_id = 1
        $users1 = EggMutasi::join('users', 'users.id', '=', 'egg_mutasis.supplier_id')
        ->select(DB::raw("SUM(qty) as total_stock"), DB::raw("strftime('%Y-%m-%d', date) as date"))
        ->where('egg_id', $this->eggid)
        ->where('users.level', '5')
        ->whereMonth('date', date('m'))
        ->groupBy(DB::raw("strftime('%Y-%m-%d', date)"))
        ->pluck('total_stock', 'date');

        // Kueri untuk supplier_id != 1
        $users2 = EggMutasi::select(DB::raw("SUM(qty) as total_stock"), DB::raw("strftime('%Y-%m-%d', date) as date"))
            ->where('egg_id', $this->eggid)
            ->where('supplier_id', '!=', '1')
            ->whereMonth('date', date('m'))
            ->groupBy(DB::raw("strftime('%Y-%m-%d', date)"))
            ->pluck('total_stock', 'date');

        $restock = EggMutasi::select(DB::raw("SUM(qty) as total_stock"), DB::raw("strftime('%Y-%m-%d', date) as date"))
                ->where('egg_id', $this->eggid)
                ->where('supplier_id', '0')
                ->whereMonth('date', date('m'))
                ->groupBy(DB::raw("strftime('%Y-%m-%d', date)"))
                ->pluck('total_stock', 'date');

        // Mengonversi tanggal menjadi format yang lebih ramah
        $labels = $users2->keys()->merge($restock->keys())->unique()->sort()->map(function ($date) {
        return date('d F', strtotime($date)); // Mengambil format tanggal dan nama bulan
        });

        // Menyiapkan data untuk dua garis
        $data1 = $users1->values();
        $data2 = $users2->values();
        $data3 = $restock->values();

        // Memastikan jumlah data sama dengan labels
        $data1 = $labels->map(function ($label) use ($users1) {
        return $users1->get(date('Y-m-d', strtotime($label)), 0);
        });

        $data2 = $labels->map(function ($label) use ($users2) {
        return $users2->get(date('Y-m-d', strtotime($label)), 0);
        });

        $data3 = $labels->map(function ($label) use ($restock) {
            return $restock->get(date('Y-m-d', strtotime($label)), 0);
        });



        return view('livewire.egg.egg-chart', [
        'labels' => $labels,
        'data1'  => $data1,
        'data2'  => $data2,
        'restock' => $data3,
        ]);
    }
}
