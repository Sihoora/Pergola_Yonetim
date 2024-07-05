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
        'ral_kodu',
        'kumas_cinsi',
        'kumas_profil_ral',
        'led_model',
        'motor_model',
        'kumanda',
        'flans',
        'arka_celik'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'proje_id');
    }
}