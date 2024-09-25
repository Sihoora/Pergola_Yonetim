<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class DashboardController extends Controller
{
    
    public function home()
    {
        $devamEdenProjeSayisi = Project::where('durum', 'ÜRETİMİ DEVAM EDEN PROJELER')->count();
        $bekletilenProjeSayisi = Project::where('durum', 'BEKLETİLEN PROJELER')->count();
        $sevkeHazirProjeSayisi = Project::where('durum', 'SEVK İÇİN HAZIR PROJELER')->count();
        $sevkEdilmisProjeSayisi = Project::where('durum', 'SEVK EDİLMİŞ PROJELER')->count();
        
        $toplamProjeSayisi = Project::count(); // Toplam proje sayısı
    
        return view('admin.include.home', compact('devamEdenProjeSayisi', 'bekletilenProjeSayisi', 'sevkeHazirProjeSayisi', 'sevkEdilmisProjeSayisi', 'toplamProjeSayisi'));
    }

   public function index()
    {
        return view('admin.include.proje_ekle');
    }
}
