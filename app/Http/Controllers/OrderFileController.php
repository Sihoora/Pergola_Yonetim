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
           $request->validate([
               'file' => 'required|file|mimes:pdf,png,jpg,jpeg,doc,docx,xlsx,txt|max:8192',
               'order_id' => 'required|exists:orders,id',
               'file_type' => 'required|string|max:255',
           ]);
   
           $file = $request->file('file');  
           $path = $file->store('order_files');
           $fileType = $request->file_type;
   
           $orderFile = new OrderFile();
           $orderFile->order_id = $request->order_id;
           $orderFile->file_path = $path;
           $orderFile->file_type = $fileType;
           $orderFile->file_name = $file->getClientOriginalName();

           $orderFile->save();
   
           return redirect()->back()->with('info', 'Dosya başarıyla yüklendi.');
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

            
        public function preview($id)
        {
            $file = OrderFile::findOrFail($id);
            $path = storage_path('app/' . $file->file_path);

            if (!file_exists($path)) {
                abort(404);
            }

            return response()->file($path);
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
