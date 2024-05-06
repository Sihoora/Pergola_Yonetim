<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proje extends Model
{
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
    ];

    // Bu modelle ilgili dönüştürülecek tarih alanları
    protected $dates = ['teslim_tarihi'];

    // Modelinizde başka özellikler veya ilişkiler (relations) tanımlayabilirsiniz.

    public function detaylar()
    {
        return $this->hasMany(ProjeDetay::class);
    }
}
