<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Urun;
use App\Models\File;
use App\HTTP\Controllers\ProductController;
use App\HTTP\Controllers\FileController;

class ProjectController extends Controller
{

    public function index()
    {
        $projeler = Project::all();
        return view("admin.include.proje_liste", compact("projeler"));
    }

    public function create()
    {
        return view('proje_ekle');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'proje_kodu' => 'required|string|max:255',
            'proje_adi' => 'required|string|max:255',
            'musteri' => 'required|string|max:255',
            'teslim_tarihi' => 'required|date',
            'durum' => 'nullable|string',
        ]);

        $proje = Project::create($request->all());
        $proje->proje_kodu = $validatedData['proje_kodu'];
        $proje->proje_adi = $validatedData['proje_adi'];
        $proje->musteri = $validatedData['musteri'];
        $proje->teslim_tarihi = $validatedData['teslim_tarihi'];
        if($proje->durum == null){
            $proje->durum = 'Yeni Proje';
        }
        $proje->save();

        return redirect()->route('proje-liste')->with('success', 'Proje başarıyla eklendi.');
    }

    public function edit($id)
    {
        $proje = Project::find($id);
        if (!$proje) {
            return redirect()->route('dashboard')->with('error', 'Proje bulunamadı.');
        }
        return view('admin.include.proje_ekle', compact('proje'));
    }

    public function update(Request $request, $id)
    {
        $proje = Project::find($id);
        $proje->proje_kodu = $request->proje_kodu;
        $proje->proje_adi = $request->proje_adi;
        $proje->musteri = $request->musteri;
        $proje->teslim_tarihi = $request->teslim_tarihi;
        $proje->durum = $request->durum;
        $proje->save();

        return redirect()->route('proje-liste')->with('success', 'Proje başarıyla güncellendi.');
    }

    public function ilerletSurec($id)
{
    
    $proje = Project::find($id);
    $sira = [
        'Yeni Proje',
        'Proje Onaylandı',
        'Üretime Gönderildi',
        'Sevk İçin Hazır'
    ];
    
    $currentIndex = array_search($proje->surec, $sira);
    
    // Eğer mevcut süreç dizide bulunuyorsa ve son aşama değilse
    if ($currentIndex !== false && $currentIndex < count($sira) - 1) {
        $proje->surec = $sira[$currentIndex + 1];
        $proje->save();
    } else {
        return redirect()->route('proje.edit', $proje->id)->with('error', 'Proje süreci zaten son aşamada, daha ileriye gidemez!');
    }
    return redirect()->route('proje.edit', $proje->id)->with('success', 'Proje süreci başarıyla ilerletildi!');


}



}



