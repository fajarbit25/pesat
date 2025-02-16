<?php

namespace App\Http\Controllers;

use App\Models\EggTransTemp;
use App\Models\EggTrx;
use App\Models\Store;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function inbound(): View
    {
        $data = [
            'title'     => 'Data Barang Masuk',
            'page'      => 'Penerimaan barang'
        ];
        return view('transaksi.inbound', $data);
    }

    public function transaksi(): View
    {
        $data = [
            'title'     => 'Barang Masuk',
            'page'      => 'Transaksi Penerimaan barang'
        ];
        return view('transaksi.transaksi', $data);
    }

    public function penjualan(): View
    {
        $data = [
            'title'     => 'Barang Keluar',
            'page'      => 'Transaksi'
        ];
        return view('transaksi.penjualan', $data);
    }

    public function pos($id): View
    {
        $data = [
            'title'     => 'Barang Keluar',
            'page'      => 'Point Of Sale',
            'userid'    => $id,
        ];
        return view('transaksi.pos', $data);
    }

    public function invoicePrint($id): View
    {
        $trx = EggTrx::where('idtransaksi', $id)->select('tipetrx', 'costumer_id', 'created_at')->first();
        if ($trx->tipetrx == 'egg') {
            $trxTemp = EggTransTemp::join('eggs', 'eggs.id', '=', 'egg_trans_temps.egg_id')
                        ->where('trx_id', $id)->select('egg_trans_temps.*', 'eggs.code', 'eggs.name')
                        ->get();
        } else {
            $trxTemp = EggTransTemp::join('medicines', 'medicines.id', '=', 'egg_trans_temps.egg_id')
                        ->where('trx_id', $id)->select('egg_trans_temps.*', 'medicines.code', 'medicines.name')
                        ->get();
        }
        $tanggal = substr($trx->created_at, 0, 10);
        $formattedDate = Carbon::parse($tanggal)->translatedFormat('l, d F Y');
        $formattedMonth = Carbon::parse($tanggal)->translatedFormat('m/Y');
        $totalTrx = $trxTemp->sum('total');

        $data = [
            'title'     => 'Invoice '.$id.' Cetak',
            'store'     => Store::join('users', 'users.id', '=', 'stores.owner')
                            ->where('stores.id', '1')->select('stores.*', 'users.name')
                            ->first(),
            'temp'      => $trxTemp,
            'total'     => $totalTrx,
            'invto'     => User::findOrFail($trx->costumer_id),
            'tanggal'   => $formattedDate,
            'bulan'     => $formattedMonth,
        ];
        return view('print.invoice', $data);
    }

    public function expense()
    {
        $data = [
            'title'     => 'Expense',
            'page'      => 'Laporang Pengeluaran',
        ];
        return view('transaksi.expense', $data);
    }

    public function laporanBarang()
    {
        $data = [
            'title'     => 'Report',
            'page'      => 'Laporang Barang',
        ];
        return view('transaksi.laporan-barang', $data);
    }
}
