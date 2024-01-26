<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function dashboard(){
        return view('dashboard');
    }
    
    public function DataInstansi(){
        return view('content.instansi');
    }

    public function DataKeterangan(){
        return view('content.keterangan');
    }

    public function DataSurat(){
        return view('content.surat');
    }
}
