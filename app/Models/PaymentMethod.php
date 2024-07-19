<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function getLogoUrlAttribute($value)
    {
        return $this->logo
            ? asset($this->logo)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active',1);
    }
}
