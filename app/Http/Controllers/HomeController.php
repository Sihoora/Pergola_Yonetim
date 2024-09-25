<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proje;


class HomeController extends Controller
{
    public function index()
    {
        $devamEdenProjeSayisi = Proje::where('durum', 'ÜRETİMİ DEVAM EDEN PROJELER')->count();
        $bekletilenProjeSayisi = Proje::where('durum', 'BEKLETİLEN PROJELER')->count();
        $sevkeHazirProjeSayisi = Proje::where('durum', 'SEVK İÇİN HAZIR PROJELER')->count();
        $sevkEdilmisProjeSayisi = Proje::where('durum', 'SEVK EDİLMİŞ PROJELER')->count();
        
        $toplamProjeSayisi = Proje::count(); // Toplam proje sayısı
    
        return view('home', compact('devamEdenProjeSayisi', 'bekletilenProjeSayisi', 'sevkeHazirProjeSayisi', 'sevkEdilmisProjeSayisi', 'toplamProjeSayisi'));
    }
    

}
