<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Project;

class ProjectNote extends Model
{
    use HasFactory;

    protected $fillable = ['proje_id', 'surec', 'not', 'checked', 'is_order_note'];


    public function proje()
    {
        return $this->belongsTo(Project::class, 'proje_id'); 
    }
}
