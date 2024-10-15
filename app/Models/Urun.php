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
        'led_alici',
        'motor_model',
        'kumanda',
        'flans',
        'arka_celik',
        'kompozit_ral',
        'arka_celik_not',
        'tasiyici_celik_ayak',
        'celik_ayak_model',
        'tasiyici_celik_not',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'proje_id');
    }
}