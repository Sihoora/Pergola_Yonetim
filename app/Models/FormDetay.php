<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormDetay extends Model
{
    protected $table = 'form_detaylar'; // Modelin hangi tabloya ait olduğunu belirtir

    protected $fillable = [
        'proje_ekle_id',
        'sistem_adi',
        'en',
        'acilim',   
        'on_yukseklik',
        'arka_yukseklik',
        'motor_tipi',
        // Diğer alanlarınızı da buraya ekleyebilirsiniz
    ];

    // Proje ile olan ilişki
    public function proje()
    {
        return $this->belongsTo(Proje::class, 'proje_ekle_id');
    }
}
