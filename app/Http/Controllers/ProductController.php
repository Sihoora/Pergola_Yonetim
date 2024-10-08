<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Urun;
use App\Models\Project;
use App\Models\ProjectNote;


class ProductController extends Controller
{
    public function storeUrun(Request $request)
    {
        $validatedData = $request->validate([
            'proje_id' => 'required|integer',
            'urun_name' => 'required|string|max:255',
            'en' => 'required|string|max:255', 
            'boy' => 'required|string|max:255', 
            'ral_kodu' => 'required|string|max:255',
            'kumas_cinsi' => 'required|string|max:255',
            'kumas_profil_ral' => 'required|string|max:255',
            'led_model' => 'required|string|max:255',
            'led_dizilim' => 'required|string|max:255',
            'led_adet' => 'required|string|max:255',
            'led_alıcı' => 'required|string|max:255',
            'motor_model' => 'required|string|max:255',
            'kumanda' => 'required|string|max:255',
            'flans' => 'required|string|max:255',
            'kompozit_ral' => 'required|string|max:255',
            'arka_celik' => 'required|string|max:255',
            'arka_celik_not' => 'required|string|max:255',
            'tasıyıcı_celik_ayak' => 'required|string|max:255',
            'celik_ayak_model' => 'required|string|max:255',
            'tasıyıcı_celik_not' => 'required|string|max:255',
        ]);

        $urun = new Urun();
        $urun->proje_id = $validatedData['proje_id'];
        $urun->urun_name = $validatedData['urun_name'];
        $urun->en = $validatedData['en'];
        $urun->boy = $validatedData['boy'];
        $urun->ral_kodu = $validatedData['ral_kodu'];
        $urun->kumas_cinsi = $validatedData['kumas_cinsi'];
        $urun->kumas_profil_ral = $validatedData['kumas_profil_ral'];
        $urun->led_model = $validatedData['led_model'];
        $urun->led_dizilim = $validatedData['led_dizilim'];
        $urun->led_adet = $validatedData['led_adet'];
        $urun->led_alıcı = $validatedData['led_alıcı'];
        $urun->motor_model = $validatedData['motor_model'];
        $urun->kumanda = $validatedData['kumanda'];
        $urun->flans = $validatedData['flans'];
        $urun->kompozit_ral = $validatedData['kompozit_ral'];
        $urun->arka_celik = $validatedData['arka_celik'];
        $urun->arka_celik_not = $validatedData['arka_celik_not'];
        $urun->tasıyıcı_celik_ayak = $validatedData['tasıyıcı_celik_ayak'];
        $urun->celik_ayak_model = $validatedData['celik_ayak_model'];
        $urun->tasıyıcı_celik_not = $validatedData['tasıyıcı_celik_not'];
        $urun->save();

        return redirect()->route('proje.edit', $urun->proje_id)->with('success', 'Ürün başarıyla eklendi. Şimdi dosya ekleyebilirsiniz.');
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
        $validatedData = $request->validate([
            'proje_id' => 'required|integer',
            'urun_name' => 'required|string|max:255',
            'en' => 'required|string|max:255', 
            'boy' => 'required|string|max:255', 
            'ral_kodu' => 'required|string|max:255',
            'kumas_cinsi' => 'required|string|max:255',
            'kumas_profil_ral' => 'required|string|max:255',
            'led_model' => 'required|string|max:255',
            'led_dizilim' => 'required|string|max:255',
            'led_adet' => 'required|string|max:255',
            'led_alıcı' => 'required|string|max:255',
            'motor_model' => 'required|string|max:255',
            'kumanda' => 'required|string|max:255',
            'flans' => 'required|string|max:255',
            'kompozit_ral' => 'required|string|max:255',
            'arka_celik' => 'required|string|max:255',
            'arka_celik_not' => 'required|string|max:255',
            'tasıyıcı_celik_ayak' => 'required|string|max:255',
            'celik_ayak_model' => 'required|string|max:255',
            'tasıyıcı_celik_not' => 'required|string|max:255',
        ]);

        $urun = Urun::findOrFail($id);
        $urun->proje_id = $validatedData['proje_id'];
        $urun->urun_name = $validatedData['urun_name'];
        $urun->en = $validatedData['en'];
        $urun->boy = $validatedData['boy'];
        $urun->ral_kodu = $validatedData['ral_kodu'];
        $urun->kumas_cinsi = $validatedData['kumas_cinsi'];
        $urun->kumas_profil_ral = $validatedData['kumas_profil_ral'];
        $urun->led_model = $validatedData['led_model'];
        $urun->led_dizilim = $validatedData['led_dizilim'];
        $urun->led_adet = $validatedData['led_adet'];
        $urun->led_alıcı = $validatedData['led_alıcı'];
        $urun->motor_model = $validatedData['motor_model'];
        $urun->kumanda = $validatedData['kumanda'];
        $urun->flans = $validatedData['flans'];
        $urun->kompozit_ral = $validatedData['kompozit_ral'];
        $urun->arka_celik = $validatedData['arka_celik'];
        $urun->arka_celik_not = $validatedData['arka_celik_not'];
        $urun->tasıyıcı_celik_ayak = $validatedData['tasıyıcı_celik_ayak'];
        $urun->celik_ayak_model = $validatedData['celik_ayak_model'];
        $urun->tasıyıcı_celik_not = $validatedData['tasıyıcı_celik_not'];
        $urun->save();

        return redirect()->route('proje.edit', $urun->proje_id)->with('success', 'Ürün başarıyla güncellendi.');

    }


    

}
