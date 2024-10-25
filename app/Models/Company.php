<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name', 'phone', 'email', 'tax_id', 'address', 'city', 'postal_code', 'contact_person', 'contact_phone'
    ];

    // Order ile ilişki
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
