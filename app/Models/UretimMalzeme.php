<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UretimMalzeme extends Model
{
    use HasFactory;

    protected $table = 'uretim_malzeme_listesi';

    protected $fillable = ['proje_id', 'file_name', 'file_path'];

    public function proje()
    {
        return $this->belongsTo(Project::class, 'proje_id');
    }
}
