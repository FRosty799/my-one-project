<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Item extends Model
{
    protected $fillable = ['name', 'description', 'price_per_day', 'image_path'];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}