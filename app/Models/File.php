<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Project;
use App\Models\Order;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'proje_id',
        'file_name',
        'file_path',
    ];

    public function proje()
    {
        return $this->belongsTo(Project::class, 'proje_id');
    }


}
