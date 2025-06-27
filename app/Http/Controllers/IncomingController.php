<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IncomingController extends Controller
{
    public function index(){
        return view('incoming');
    }
}
