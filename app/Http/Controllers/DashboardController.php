<?php

namespace App\Http\Controllers;

use App\Models\Egg;
use App\Models\EggTrx;
use App\Models\Hutang;
use App\Models\HutangPlasma;
use App\Models\UpahBuruh;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function  index(): View
    {
        $data = [
            'title'         => 'Dashboard',
            'page'          => 'Dashboard',
            'costumers'     => $this->countCostumser(),
            'piutang'       => $this->sumPiutang(),
            'hutang'        => $this->sumHutang(),
            'piutangMines'  => $this->sumPiutangMines(),
            'pemasukan'     => $this->getPemasukan(),
            'pembelian'     => $this->getPengeluaran(),
            'upahBuruh'     => $this->upahBuruh(),
        ];
        return view('dashboard', $data);
    }


    public function countCostumser()
    {
        return User::where('level', '3')->count() ?? 0;
    }

    public function sumPiutang()
    {
        return HutangPlasma::where('hutang', '>', 0)->sum('hutang') ?? 0;
    }

    public function sumPiutangMines()
    {
        return HutangPlasma::where('hutang', '<', 1)->sum('hutang') ?? 0;
    }

    public function sumHutang()
    {
        return Hutang::where('status', 'pending')->sum('jumlah') ?? 0;
    }

    public function getPemasukan()
    {
        $data = [
            'hari'      => EggTrx::where('trxtipe', 'penjualan')
                            ->whereDate('created_at', today())
                            ->sum('totalprice') ?? 0,
            'minggu'    => EggTrx::where('trxtipe', 'penjualan')
                            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                            ->sum('totalprice') ?? 0,
            'bulan'     => EggTrx::where('trxtipe', 'penjualan')
                            ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
                            ->sum('totalprice') ?? 0,
        ];
        return $data;
    }

    public function getPengeluaran()
    {
        $data = [
            'hari'      => EggTrx::where('trxtipe', 'pembelian')
                            ->whereDate('created_at', today())
                            ->sum('totalprice') ?? 0,
            'minggu'    => EggTrx::where('trxtipe', 'pembelian')
                            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                            ->sum('totalprice') ?? 0,
            'bulan'     => EggTrx::where('trxtipe', 'pembelian')
                            ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
                            ->sum('totalprice') ?? 0,
        ];
        return $data;
    }

    public function upahBuruh()
    {
        return UpahBuruh::where('status', 'pending')->sum('amount') ?? 0;
    }

}
