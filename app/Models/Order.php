<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderFile;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'order_type',
        'product_name',
        'quantity',
        'created_by',
    ];

        // Kullanıcıyla ilişki tanımı
        public function user()
        {
            return $this->belongsTo(User::class, 'created_by');
        }

        // Order Files ile ilişki tanımı
        public function order_files()
        {   
            return $this->hasMany(OrderFile::class, 'order_id');  // hasMany ilişkisinin ismi 'order_files'
        }

}
