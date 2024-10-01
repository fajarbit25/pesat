<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index():View
    {
        $data = [
            'title'     => 'Master Data Obat',
            'page'      => 'Master Obat',
        ];
        return view('medicine.data', $data);
    }

    public function settings():View
    {
        $data = [
            'title'     => 'Master Obat Settings',
            'page'      => 'Master Obat Setting'
        ];
        return view('medicine.settings', $data);
    }

    public function transaksi():View
    {
        $data = [
            'title'     => 'Transaksi',
            'page'      => 'Transaksi Obat'
        ];
        return view('medicine.transaksi', $data);
    }
}
