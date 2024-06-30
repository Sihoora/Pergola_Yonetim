<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Urun;

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
        ]);

        $proje = new Project();
        $proje->proje_kodu = $validatedData['proje_kodu'];
        $proje->proje_adi = $validatedData['proje_adi'];
        $proje->musteri = $validatedData['musteri'];
        $proje->teslim_tarihi = $validatedData['teslim_tarihi'];
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
        $proje->save();

        return redirect()->route('proje-liste')->with('success', 'Proje başarıyla güncellendi.');
    }
}
//------------------------------------------------------------




