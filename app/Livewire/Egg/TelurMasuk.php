<?php

namespace App\Livewire\Egg;

use App\Models\Egg;
use App\Models\EggMutasi;
use App\Models\EggTransTemp;
use App\Models\ReporManual;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TelurMasuk extends Component
{
    public $tanggal;
    public $items;
    public $stockAwal;
    public $stockOut;

    public $jemputan;
    public $tJalan;
    public $sAwal;
    public $catatan;

    public function mount()
    {
        $this->tanggal = now()->toDateString();
        $this->updatedtanggal();
    }

    public function render()
    {
        $this->getItems();
        $this->getStock();
        $this->telurKeluar();
        return view('livewire.egg.telur-masuk');
    }

    public function getItems()
    {
        $this->items = EggTransTemp::join('egg_trxes', 'egg_trxes.idtransaksi', '=', 'egg_trans_temps.trx_id')
                    ->join('users', 'users.id', '=', 'egg_trxes.costumer_id')
                    ->join('eggs', 'eggs.id', '=', 'egg_trans_temps.egg_id')
                    ->where('trxtipe', 'pembelian')->where('tipetrx', 'egg')
                    ->where('eggs.id', '!=', '3')
                    ->whereDate('egg_trans_temps.created_at', $this->tanggal)
                    ->select('egg_trxes.keterangan', 'users.name', 'qty', 'users.id as userid', 'eggs.id as egg_id', 'eggs.name as telur')
                    ->get();
    }

    public function updatedtanggal()
    {
        $data = ReporManual::whereDate('tanggal', $this->tanggal)->first();
        $this->jemputan = $data->jemputan ?? 0;
        $this->tJalan = $data->tjalan ?? 0;
        $this->sAwal = $data->stockAwal ?? 0;
        $this->catatan = $data->catatan ?? '';
    }
     
    public function getStock()
    {
        $besar =  EggMutasi::where('egg_id', '1')
        ->whereDate('date', $this->tanggal)
        ->orderByDesc('id')
        ->select('atockakhir')
        ->first();

        $kecil = EggMutasi::where('egg_id', '2')
        ->whereDate('date', $this->tanggal)
        ->orderByDesc('id')
        ->select('atockakhir')
        ->first();

        $stockBesar = $besar->atockakhir ?? 0;
        $stockKecil = $kecil->atockakhir ?? 0;

        $this->stockAwal = $stockBesar+$stockKecil;
    }

    public function telurKeluar()
    {
        $this->stockOut = EggTransTemp::join('egg_trxes', 'egg_trxes.idtransaksi', '=', 'egg_trans_temps.trx_id')
                    ->where('trxtipe', 'penjualan')->where('tipetrx', 'egg')
                    ->join('eggs', 'eggs.id', '=', 'egg_trans_temps.egg_id')
                    ->where('eggs.id', '!=', '3')
                    ->whereDate('egg_trans_temps.created_at', $this->tanggal)
                    ->sum('qty');
    }

    public function saveReportManual()
    {
        $this->validate([
            'jemputan'      => 'required',
            'tJalan'        => 'required',
            'sAwal'         => 'required',
        ]);

        if (!$this->catatan){
            $noted = "-";
        } else {
            $noted = $this->catatan;
        }

        try {

            $cek = ReporManual::whereDate('tanggal', $this->tanggal)->first();

            if (!$cek) {
                ReporManual::create([
                    'tanggal'       => $this->tanggal,
                    'jemputan'      => $this->jemputan,
                    'stokawal'      => $this->sAwal,
                    'tjalan'        => $this->tJalan,
                    'stockakhir'    => $this->jemputan+$this->sAwal-$this->tJalan,
                    'catatan'       => $noted,
                    'user_id'       => Auth::user()->id,
                ]);
            } else {
                $load = ReporManual::findOrFail($cek->id);
                $load->update([
                    'tanggal'       => $this->tanggal,
                    'jemputan'      => $this->jemputan,
                    'stokawal'      => $this->sAwal,
                    'tjalan'        => $this->tJalan,
                    'stockakhir'    => $this->jemputan+$this->sAwal-$this->tJalan,
                    'catatan'       => $noted,
                    'user_id'       => Auth::user()->id,
                ]);
            }


            $this->dispatch('alert', [
                'title'     => 'Success',
                'message'   => 'Laporan diperbaharui',
                'icon'      => 'success',
            ]);

        } catch (\Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Stock Telur gagal diedit!',
                'icon'      => 'error',
                'error'     => $e->getMessage(),
            ]);
        }
    }

}
