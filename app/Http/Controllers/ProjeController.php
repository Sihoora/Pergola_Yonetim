<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proje;


class ProjeController extends Controller
{


    public function store(Request $request)
{
    $proje = new Proje;
    $proje->proje_kodu = $request->input('proje_kodu');
    $proje->proje_adi = $request->input('proje_adi');
    $proje->musteri = $request->input('musteri');
    $proje->teslim_tarihi = $request->input('teslim_tarihi');
    $proje->urun_ailesi = $request->input('urun_ailesi');
    $proje->urun_grubu = $request->input('urun_grubu');
    $proje->urun_alt_grubu = $request->input('urun_alt_grubu');
    $proje->uretim_sablonu = $request->input('uretim_sablonu');

    $proje->save();

    $request->validate([
        'proje_kodu' => 'required|integer',
        'proje_adi' => 'required|string|max:255',
        'musteri' => 'required|string|max:255',
        'teslim_tarihi' => 'string',
        // Diğer alanlarınız için de benzer doğrulamalar yapabilirsiniz.
    ]);


    return redirect()->back()->with('success', 'Proje başarıyla kaydedildi.');

    


}
}
