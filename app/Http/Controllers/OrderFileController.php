<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderFile;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Exception;


class OrderFileController extends Controller
{
    //
       // Dosya yükleme metodu
       public function upload(Request $request)
       {
           // Dosya yükleme doğrulama kuralları
           $request->validate([
               'file' => 'required|file|mimes:pdf,png,jpg,jpeg,doc,docx,xlsx,txt|max:8192',
               'order_id' => 'required|exists:orders,id',
               'file_type' => 'required|string|max:255',
           ]);
       
           $file = $request->file('file');
           $filename = $file->getClientOriginalName();
       
           // Dosyayı public diskinde 'order_files' klasörüne yükle
           $path = $file->storeAs('order_files', $filename, 'public');
           
       
           // Veritabanına 'order_files/filename' formatında yolu kaydet
           $orderFile = new OrderFile();
           $orderFile->order_id = $request->order_id;
           $orderFile->file_path = $path; // `order_files/filename` şeklinde kaydedilir
           $orderFile->file_type = $request->file_type;
           $orderFile->file_name = $filename;
           $orderFile->save();
       
           return redirect()->back()->with('success', 'Dosya başarıyla yüklendi.');
       }

       




       public function preview($id)
       {
           $file = OrderFile::findOrFail($id);
           $path = storage_path('app/' . $file->file_path);
       
           if (!file_exists($path)) {
               abort(404);
           }
       
           return response()->file($path);
       }

       public function showFile($filename)
       {
           // Tam dosya yolunu tanımla
           $path = storage_path('app/order_files/' . $filename);
       
           // Eğer dosya mevcut değilse hata döndür
           if (!file_exists($path)) {
               abort(404, 'Dosya bulunamadı.');
           }
       
           // Dosya tipini dinamik olarak ayarla
           $mimeType = mime_content_type($path);
       
           // Dosyayı doğru MIME türü ile döndür
           return response()->file($path, [
               'Content-Type' => $mimeType,
           ]);
       }
       

       
   
       // Dosyaları listeleme metodu
       public function getFiles($orderId)
       {
           $files = OrderFile::where('order_id', $orderId)->get();
           return view('admin.include.orders.order_detail', compact('files'));
       }
   
       // Dosya indirme metodu
       public function download($id)
       {
           $file = OrderFile::findOrFail($id);
           return Storage::download($file->file_path, $file->file_name);
       }

            
 
       
       // Dosya silme metodu
       public function delete($id)
       {
           $file = OrderFile::findOrFail($id);
           Storage::delete($file->file_path);
           $file->delete();
   
           return redirect()->back()->with('success', 'Dosya başarıyla silindi.');
       }
}
