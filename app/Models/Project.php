<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Urun;
use App\Models\File;
use App\Models\ProjectNote; 

class Project extends Model
{

    use HasFactory;

    // Eğer farklı bir tablo adı kullanıyorsanız belirtin, varsayılan isim projeler olacaktır.
    protected $table = 'proje_ekle'; // Örnek tablo ismi. Gerçek tablo isminize göre değiştirin.

    // Eloquent'in created_at ve updated_at tarihlerini otomatik olarak işlemesini istiyorsanız, bu satırı olduğu gibi bırakın.
    public $timestamps = true;

    // Formdan gelen verilerin toplu atamasına izin verilen alanlar
    protected $fillable = [
        'proje_kodu', 
        'proje_adi', 
        'musteri', 
        'teslim_tarihi', 
        'durum',
    ];

    // Bu modelle ilgili dönüştürülecek tarih alanları
    protected $dates = ['teslim_tarihi'];


    public function urunler()
    {
        return $this->hasMany(Urun::class, 'proje_id',);
    }

    public function files() 
    {
        return $this->hasMany(File::class, 'proje_id');
    }

    public function notlar()
    {   
        return $this->hasMany(ProjectNote::class, 'proje_id');
    }
    
}
