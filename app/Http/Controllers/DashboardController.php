<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    

    public function home()
    {
        return view('admin.include.home');
    }

   public function index()
    {
        return view('admin.include.proje_ekle');
    }
}
