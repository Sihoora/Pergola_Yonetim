<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Urun;
use App\Models\Project;

class ProductController extends Controller
{
    public function storeUrun(Request $request)
    {
        $validatedData = $request->validate([
            'proje_id' => 'required|integer',
            'urun_name' => 'required|string|max:255',
            'ral_kodu' => 'required|string|max:255',
            'kumas_cinsi' => 'required|string|max:255',
            'kumas_profil_ral' => 'required|string|max:255',
            'led_model' => 'required|string|max:255',
            'motor_model' => 'required|string|max:255',
            'kumanda' => 'required|string|max:255',
            'flans' => 'required|string|max:255',
            'arka_celik' => 'required|string|max:255',
        ]);

        $urun = new Urun();
        $urun->proje_id = $validatedData['proje_id'];
        $urun->urun_name = $validatedData['urun_name'];
        $urun->ral_kodu = $validatedData['ral_kodu'];
        $urun->kumas_cinsi = $validatedData['kumas_cinsi'];
        $urun->kumas_profil_ral = $validatedData['kumas_profil_ral'];
        $urun->led_model = $validatedData['led_model'];
        $urun->motor_model = $validatedData['motor_model'];
        $urun->kumanda = $validatedData['kumanda'];
        $urun->flans = $validatedData['flans'];
        $urun->arka_celik = $validatedData['arka_celik'];
        $urun->save();

        return redirect()->route('proje-liste')->with('urun_id', $urun->id)->with('success', 'Ürün başarıyla eklendi.');        
    }

    public function getUrunler($projeId)
    {
        $urunler = Urun::where('proje_id', $projeId)->get();
        return response()->json($urunler);
    }

    public function editUrun($id)
    {
        $urun = Urun::findOrFail($id);
        return response()->json($urun);
    }

    public function updateUrun(Request $request, $id)
    {
        $urun = Urun::findOrFail($id);
        $urun->update($request->all());
        return redirect()->route('proje.edit', $urun->proje_id)->with('success', 'Ürün başarıyla güncellendi.');
    }   
}
