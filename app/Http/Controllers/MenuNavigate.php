<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuNavigate extends Controller
{
    //


    public function index()
    {
        return view("admin.include.proje_ekle");
    }
}
