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
        $users1 = EggMutasi::select(DB::raw("SUM(qty) as total_stock"), DB::raw("strftime('%Y-%m-%d', date) as date"))
        ->where('egg_id', $this->eggid)
        ->where('supplier_id', '1')
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

        // Mengonversi tanggal menjadi format yang lebih ramah
        $labels = $users1->keys()->merge($users2->keys())->unique()->sort()->map(function ($date) {
        return date('d F', strtotime($date)); // Mengambil format tanggal dan nama bulan
        });

        // Menyiapkan data untuk dua garis
        $data1 = $users1->values();
        $data2 = $users2->values();

        // Memastikan jumlah data sama dengan labels
        $data1 = $labels->map(function ($label) use ($users1) {
        return $users1->get(date('Y-m-d', strtotime($label)), 0);
        });

        $data2 = $labels->map(function ($label) use ($users2) {
        return $users2->get(date('Y-m-d', strtotime($label)), 0);
        });

        return view('livewire.egg.egg-chart', [
        'labels' => $labels,
        'data1'  => $data1,
        'data2'  => $data2,
        ]);
    }
}
