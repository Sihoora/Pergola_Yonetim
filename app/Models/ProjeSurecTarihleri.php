<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Project;

class ProjeSurecTarihleri extends Model
{
    use HasFactory;

    protected $table = 'proje_surec_tarihleri';
    protected $fillable = ['proje_id', 'surec', 'tarih'];


    public function project()
    {
        return $this->belongsTo(Project::class, 'proje_id');
    }
}
