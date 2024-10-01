<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $data = [
            'title'     => 'Data Karyawan',
            'page'      => 'Karyawan'
        ];
        return view('user.list', $data);
    }

    public function password(): View
    {
        $data = [
            'title'     => 'User',
            'page'      => 'Change Password'
        ];
        return view('user.password', $data);
    }

    public function store(): View
    {
        $data = [
            'title'     => 'Toko',
            'page'      => 'Update Toko'
        ];
        return view('user.toko', $data);
    }
}
