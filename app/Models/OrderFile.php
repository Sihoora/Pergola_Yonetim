<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class OrderFile extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'file_name', 'file_path', 'file_type'];

    // Order ile ilişkilendirme
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');  // belongsTo ilişkisinin ismi 'order'
    }

    
}