<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class EggController extends Controller
{
    public function index(): View
    {
        $data = [
            'title'     => 'Stok Telur',
            'page'      => 'Stock Telur',
        ];
        return view('egg.index', $data);
    }

    public function inbound(): View
    {
        $data = [
            'title'     => 'Transaksi',
            'page'      => 'Pembelian',
        ];
        return view('egg.inbound', $data);
    }

    public function outbound(): View
    {
        $data = [
            'title'     => 'Transaksi',
            'page'      => 'Penjualan',
        ];
        return view('egg.outbound', $data);
    }

    public function mutasi($id): View
    {
        $data = [
            'title'     => 'Mutasi',
            'page'      => 'Mutasi Stok Telur',
            'id'        => $id,
        ];
        return view('egg.mutasi', $data);
    }

    public function report(): View
    {
        $data = [
            'title'     => 'Laporan',
            'page'      => 'Laporan Transaksi Telur',
        ];
        return view('egg.report', $data);
    }
}
