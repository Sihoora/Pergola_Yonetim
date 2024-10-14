<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Exception\Handler;

class FileController extends Controller
{

  // Dosya yükleme metodu
  public function upload(Request $request)
  {
      $request->validate([
          'file' => 'required|file|mimes:dwg,pdf,png,jpg,jpeg,doc,docx,xlsx,txt|max:8192',
          'proje_id' => 'required|exists:proje_ekle,id',
          'file_type' => 'required|string|max:255',
      ]);

      $file = $request->file('file');
      $path = $file->store('files');
      $fileType = $request->file_type;

      $fileModel = new File();
      $fileModel->proje_id = $request->proje_id;
      $fileModel->file_path = $path;
      $fileModel->file_type = $fileType;
      $fileModel->file_name = $file->getClientOriginalName();
      $fileModel->save();

      return redirect()->back()->with('info', 'Dosya başarıyla yüklendi.');
  }

  // Dosyaları listeleme metodu
  public function getFiles($projeId)
  {
      $files = File::where('proje_id', $projeId)->get();
      return view('files_list', compact('files'));
  }

  // Dosya indirme metodu
  public function download($id)
  {
      $file = File::findOrFail($id);
      return Storage::download($file->file_path, $file->file_name);
  }

  // Dosya silme metodu
  public function delete($id)
  {
      $file = File::findOrFail($id);
      Storage::delete($file->file_path);
      $file->delete();
      
      return redirect()->back()->with('success', 'Dosya başarıyla silindi.');
  }


  public function showFileSize($fileName)
{
    $filePath = storage_path('app/uploads/' . $fileName);

    try {
        if (!file_exists($filePath)) {
            throw new Exception("Dosya mevcut değil.");
        }

        if (!is_readable($filePath)) {
            throw new Exception("Dosya okunabilir değil.");
        }

        $fileSize = filesize($filePath);
        if ($fileSize === false) {
            throw new Exception("Dosya boyutu alınamıyor.");
        }

        return response()->json(['size' => $fileSize]);

    } catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


public function preview($id)
{
    $file = File::findOrFail($id);
    $path = storage_path('app/' . $file->file_path);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
}



}

