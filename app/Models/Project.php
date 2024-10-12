<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Urun;
use App\Models\File;
use App\Models\ProjeSurecTarihleri;
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
        'created_by',
        'proje_adi', 
        'musteri', 
        'teslim_tarihi', 
        'durum',
    ];

    // Bu modelle ilgili dönüştürülecek tarih alanları
    protected $dates = ['teslim_tarihi'];

    // Proje modelinin oluşturucu kullanıcıyla ilişkisini tanımlayın
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by'); // 'created_by' alanı, projenin hangi kullanıcı tarafından oluşturulduğunu belirtir
    }

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

    // UretimMalzeme modeli ile ilişki
    public function uretimMalzemeleri()
    {
        return $this->hasMany(UretimMalzeme::class, 'proje_id');
    }

    // ProjeSurecTarihleri modeli ile ilişki
    public function surecTarihleri()
    {
        return $this->hasMany(ProjeSurecTarihleri::class, 'proje_id');
    }
    
}
