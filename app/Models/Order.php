<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderFile;
use App\Models\Company;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'company_id',
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
            return $this->hasMany(OrderFile::class, 'order_id'); 
        }

        // Order Notes ile ilişki tanımı
        public function order_notes()
        {
            return $this->hasMany(OrderNote::class, 'order_id'); 
        }

          
        public function company()
        {
            return $this->belongsTo(Company::class, 'company_id'); 
        }

}
