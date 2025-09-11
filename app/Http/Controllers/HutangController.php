<?php

namespace App\Http\Controllers;

use App\Models\EggTrx;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HutangController extends Controller
{
    public function index(): View
    {
        $data = [
            'title'     => 'Piutang',
            'page'      => 'Catatan Piutang Plasma',
        ];
        return view('hutang.index', $data);
    }

    public function detail($id): View
    {
        $data = [
            'title'     => 'Piutang',
            'page'      => 'Detail Catatan Piutang',
            'userid'    => $id,
        ];
        return view('hutang.detail', $data);
    }

    public function debt(): View
    {
        $data = [
            'title'     => 'Hutang',
            'page'      => 'Detail Catatan Hutang'
        ];
        return view('hutang.debt', $data);
    }

    public function upahBuruh(): View
    {
        $data = [
            'title'     => 'Upah',
            'page'      => 'Upah Buruh',
        ];
        return view('hutang.upah-buruh', $data);
    }

    public function debtdetail($id): View
    {
        $data = [
            'title'     => 'Hutang',
            'page'      => 'Detail Catatan Hutang',
            'userid'    => $id,
        ];
        return view('hutang.debtdetail', $data);
    }

    public function buyer(): View
    {
        $data = [
            'title'     => 'Hutang buyer',
            'page'      => 'Detail Catatan Hutang Kepada Buyer',
        ];
        return view('hutang.buyer', $data);
    }

    public function buyerDetail($id): View
    {
        $data = [
            'title'     => 'Hutang buyer',
            'page'      => 'Detail Catatan Hutang Kepada Buyer',
            'userid'    => $id,
        ];
        return view('hutang.buyer-detail', $data);
    }

    public function hargaTelur(): View
    {
        $data = [
            'title'     => 'Harga Telur',
            'page'      => 'Harga Telur Per Costumer',
        ];
        return view('hutang.harga-telur', $data);
    }

    public function cetak($id, $month)
    {
        $bulan = substr($month, 5, 2);
        $formattedDate = Carbon::createFromFormat('Y-m', $month);

        $telur = EggTrx::leftJoin('egg_trans_temps', 'egg_trans_temps.trx_id', '=', 'egg_trxes.idtransaksi')
                        ->join('eggs', 'eggs.id', '=', 'egg_trans_temps.egg_id')
                        ->where('egg_trxes.costumer_id', $id)
                        ->where('trxtipe', 'pembelian')->where('tipetrx', 'egg')
                        ->whereMonth('egg_trans_temps.created_at', $bulan)
                        ->select('egg_trxes.*', 'eggs.id as idbarang', 'eggs.name', 'egg_trans_temps.created_at as tanggal', 'egg_trans_temps.qty',
                        'egg_trans_temps.price', 'egg_trans_temps.total', 'disc')->orderBy('egg_trans_temps.created_at', 'ASC')->get();
        $produks = EggTrx::leftJoin('egg_trans_temps', 'egg_trans_temps.trx_id', '=', 'egg_trxes.idtransaksi')
                        ->join('medicines', 'medicines.id', '=', 'egg_trans_temps.egg_id')
                        ->where('egg_trxes.costumer_id', $id)
                        ->where('trxtipe', 'penjualan')
                        ->where('tipetrx', '!=', 'egg')
                        ->where('egg_trans_temps.egg_id', '!=', '120')
                        ->whereMonth('egg_trans_temps.created_at', $bulan)
                        ->select('egg_trxes.*', 'medicines.id as idbarang', 'medicines.name', 'egg_trans_temps.created_at as tanggal', 'egg_trans_temps.qty',
                        'egg_trans_temps.price', 'egg_trans_temps.total', 'disc')->orderBy('egg_trans_temps.created_at', 'ASC')->get();
        $data = [
            'title'     => 'Laporan Bulan '.$formattedDate->translatedFormat('F Y'),
            'telurs'    => $telur,
            'produks'   => $produks,
            'user'      => User::find($id),
            'bulan'     => $formattedDate->translatedFormat('F Y'),
            'segment'   => 'barang',
        ];
        return view('print.hutang', $data);
    }

    public function cetakTelur($id, $month)
    {
        $bulan = substr($month, 5, 2);
        $formattedDate = Carbon::createFromFormat('Y-m', $month);

        $telur = EggTrx::leftJoin('egg_trans_temps', 'egg_trans_temps.trx_id', '=', 'egg_trxes.idtransaksi')
                        ->join('eggs', 'eggs.id', '=', 'egg_trans_temps.egg_id')
                        ->where('egg_trxes.costumer_id', $id)
                        ->where('trxtipe', 'pembelian')->where('tipetrx', 'egg')
                        ->whereMonth('egg_trans_temps.created_at', $bulan)
                        ->select('egg_trxes.*', 'eggs.id as idbarang', 'eggs.name', 'egg_trans_temps.created_at as tanggal', 'egg_trans_temps.qty',
                        'egg_trans_temps.price', 'egg_trans_temps.total', 'disc')->orderBy('egg_trans_temps.created_at', 'ASC')->get();
        $produks = EggTrx::leftJoin('egg_trans_temps', 'egg_trans_temps.trx_id', '=', 'egg_trxes.idtransaksi')
                        ->join('medicines', 'medicines.id', '=', 'egg_trans_temps.egg_id')
                        ->where('egg_trxes.costumer_id', $id)
                        ->where('trxtipe', 'penjualan')
                        ->where('tipetrx', '!=', 'egg')
                        ->where('egg_trans_temps.egg_id', '!=', '120')
                        ->whereMonth('egg_trans_temps.created_at', $bulan)
                        ->select('egg_trxes.*', 'medicines.id as idbarang', 'medicines.name', 'egg_trans_temps.created_at as tanggal', 'egg_trans_temps.qty',
                        'egg_trans_temps.price', 'egg_trans_temps.total', 'disc')->orderBy('egg_trans_temps.created_at', 'ASC')->get();
        $data = [
            'title'     => 'Laporan Bulan '.$formattedDate->translatedFormat('F Y'),
            'telurs'    => $telur,
            'produks'   => $produks,
            'user'      => User::find($id),
            'bulan'     => $formattedDate->translatedFormat('F Y'),
            'segment'   => 'telur'
        ];
        return view('print.hutang', $data);
    }

}
