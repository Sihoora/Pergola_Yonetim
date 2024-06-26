<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class MenuNavigate extends Controller
{
    //


    public function index()
    {
        return view("admin.include.proje_ekle");
    }

}
