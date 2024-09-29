<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Urun;
use App\Models\File;
use App\Models\ProjectNote;
use App\HTTP\Controllers\ProductController;
use App\HTTP\Controllers\FileController;
use PDF;

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
            'proje_kodu' => 'required|string|max:255|unique:proje_ekle,proje_kodu',
            'proje_adi' => 'required|string|max:255',
            'musteri' => 'required|string|max:255', 
            'teslim_tarihi' => 'required|string|max:255',
        ]);

        $proje = Project::create($request->all());
        $proje->proje_kodu = $validatedData['proje_kodu'];
        $proje->proje_adi = $validatedData['proje_adi'];
        $proje->musteri = $validatedData['musteri'];
        $proje->teslim_tarihi = $validatedData['teslim_tarihi'];

   
        $proje->save();

        $this->ekleSabitNotlar($proje->id);

        return redirect()->route('proje.edit', $proje->id)->with('success', 'Proje başarıyla eklendi. Şimdi ürün ekleyebilirsiniz.');

        
    }

    
    public function ekleSabitNotlar($project_id)
{
    $sabit_notlar = [
      'Yeni Proje' => ['Proje bilgileri girildi.', 'Ürün bilgileri girildi.', 'Genel dosyalar yüklendi.'],
                        'Proje Onaylandı' => ['Proje onayı alındı.','Deneme Sabit Not' ],
                        'Teknik Çizimler Yapıldı' => ['Teknik çizimler tamamlandı.'],
                        'Üretime Gönderildi' => ['Üretim süreci başlatıldı.'],
                        'Sevk İçin Hazır' => ['Ürünler sevk için hazır.'],
                        'Sevk Edildi' => ['Ürünler sevk edildi.', 'Proje tamamlandı.']
                    ];

    foreach ($sabit_notlar as $surec => $notlar) {
        foreach ($notlar as $not) {
                $not = new ProjectNote([
                    'proje_id' => $project_id,
                    'surec' => $surec,
                    'not' => $not,
                    'checked' => false
                ]);
                $not->save();
            
        }
    }

    return response()->json(['status' => 'success']);
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


    public function ilerletSurec($id)
{
    $proje = Project::find($id);
    
    // Süreç sırası dizisi
    $sira = [
        'Yeni Proje',
        'Proje Onaylandı',
        'Teknik Çizimler Yapıldı',
        'Üretime Gönderildi',
        'Sevk İçin Hazır',
        'Sevk Edildi'
    ];

    // Süreç ile Durum eşleşmesi
    $durumEslesmesi = [
        'Yeni Proje' => 'BEKLETİLEN PROJELER',
        'Proje Onaylandı' => 'BEKLETİLEN PROJELER',
        'Teknik Çizimler Yapıldı' => 'ÜRETİMİ DEVAM EDEN PROJELER',
        'Üretime Gönderildi' => 'ÜRETİMİ DEVAM EDEN PROJELER',
        'Sevk İçin Hazır' => 'SEVK İÇİN HAZIR PROJELER',
        'Sevk Edildi' => 'SEVK EDİLMİŞ PROJELER',
    ];

    
    // Mevcut sürecin indexini al
    $currentIndex = array_search($proje->surec, $sira);
    
    // Eğer mevcut süreç dizide bulunuyorsa ve son aşama değilse
    if ($currentIndex !== false && $currentIndex < count($sira) - 1) {
        // Süreci bir sonraki adıma ilerlet
        $proje->durum = $durumEslesmesi[$proje->surec];

        $proje->surec = $sira[$currentIndex + 1];

        // Durumu da eşleşmeye göre güncelle
        $proje->durum = $durumEslesmesi[$proje->surec];
        
        // Veritabanında güncelle
        $proje->save();

        return redirect()->route('proje.detay', $proje->id)->with('warning', 'Proje süreci başarıyla ilerletildi!');
    } else {
        return redirect()->route('proje.detay', $proje->id)->with('error', 'Proje süreci zaten son aşamada, daha ileriye gidemez!');
    }
}


public function show($id)
{
    $proje = Project::with('urunler', 'files')->find($id);

    if (!$proje) {
        return redirect()->route('proje-liste')->with('error', 'Proje bulunamadı.');
    }

    return view('admin.include.proje_detay', compact('proje'));
}


public function storeNote(Request $request)
{
    $request->validate([
        'proje_id' => 'required|string|exists:proje_ekle,id',
        'surec' => 'required|string',
        'not' => 'required|string',
    ]);

    $note = new ProjectNote();
    $note->proje_id = $request->input('proje_id');
    $note->surec = $request->input('surec');
    $note->is_order_note = $request->input('is_order_note') ? true : false;
    $note->not = $request->input('not');
    $note->save();
    
    return redirect()->back()->with('success', 'Not başarıyla eklendi.');
}


public function updateNoteStatus(Request $request, $noteId)
{
    $note = ProjectNote::findOrFail($noteId);
    $note->tamamlandi = $request->input('tamamlandi') ? true : false;
    $note->save();

    return response()->json(['status' => 'success']);
}



public function toggleCheckbox($noteId, Request $request)
{
    $type = $request->input('type'); // Checkbox türü alınıyor

    if ($type == 'dynamic') {
        $note = ProjectNote::find($noteId);
        if ($note) {
            $note->checked = $request->input('checked'); // 'checked' alanı güncelleniyor
            $note->save();
            return response()->json(['status' => 'success']);
        }
    } else {
        // Sabit notlar için özel bir işlem gerekiyorsa burada yapılabilir
        // Örneğin, sabit notların durumu session ya da belirli bir key'de saklanabilir
    }

    return response()->json(['status' => 'error']);
}


public function generatePDF($id)
{
    // İlgili projeyi ve ürün bilgilerini veritabanından çekiyoruz
    $proje = Project::with('urunler')->findOrFail($id);

    // Proje notlarını çekiyoruz
    $siparisNotlari = ProjectNote::where('proje_id', $id)
    ->where('is_order_note', 1)
    ->get();


    // PDF görünümü için gerekli verileri ayarlıyoruz
    $data = [
        'proje' => $proje,
        'siparisNotlari' => $siparisNotlari, // Sipariş notlarını PDF'de kullanmak için ekledik
        'logo' =>  public_path('admin/dist/img/PDF_LOGO.png') // Logonun bulunduğu yolu buraya ekleyin
    ];

    // PDF dökümanını oluşturup, kullanıcıya indirme veya görüntüleme seçeneği sunuyoruz
    $pdf = PDF::loadView('pdf.proje_detay', $data);

    // İndirilebilir PDF dökümanı olarak döndürüyoruz
    return $pdf->download('proje_detay_'.$proje->id.'.pdf');
}




}



