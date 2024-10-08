<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Http\Models\Project;


class Urun extends Model
{
    use HasFactory;

    protected $fillable = [
        'proje_id',
        'urun_name',
        'en',
        'boy',
        'ral_kodu',
        'kumas_cinsi',
        'kumas_profil_ral',
        'led_model',
        'led_dizilim',
        'led_adet',
        'led_alıcı',
        'motor_model',
        'kumanda',
        'flans',
        'arka_celik',
        'kompozit_ral',
        'arka_celik_not',
        'taşıyıcı_çelik_ayak',
        'çelik_ayak_model',
        'taşıyıcı_çelik_not',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'proje_id');
    }
}