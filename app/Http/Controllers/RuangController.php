<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RuangController extends Controller
{
    public function index()
    {
        return view('ruang');
    }

    public function tambah()
    {
        return view('create-ruang');
    }
}
