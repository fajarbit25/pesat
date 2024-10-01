<?php

namespace App\Http\Controllers;

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
}
