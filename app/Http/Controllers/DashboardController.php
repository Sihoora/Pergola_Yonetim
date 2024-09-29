<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Controllers\ProjectController;


class DashboardController extends Controller
{
    
    public function home()
    {
        $projeler = Project::all();
        $devamEdenProjeSayisi = Project::where('durum', 'ÜRETİMİ DEVAM EDEN PROJELER')->count();
        $bekletilenProjeSayisi = Project::where('durum', 'BEKLETİLEN PROJELER')->count();
        $sevkeHazirProjeSayisi = Project::where('durum', 'SEVK İÇİN HAZIR PROJELER')->count();
        $sevkEdilmisProjeSayisi = Project::where('durum', 'SEVK EDİLMİŞ PROJELER')->count();
        
        $toplamProjeSayisi = Project::count(); // Toplam proje sayısı
    
        return view('admin.include.home', compact('devamEdenProjeSayisi', 'bekletilenProjeSayisi', 'sevkeHazirProjeSayisi', 'sevkEdilmisProjeSayisi', 'toplamProjeSayisi','projeler'));
    }

   public function index()
    {
        return view('admin.include.proje_ekle');
    }
}
