<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Rental extends Model
{
    protected $fillable = ['user_id', 'item_id', 'start_date', 'end_date', 'total_price', 'status'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isOwnedByCurrentUser(): bool
    {
        return $this->user_id === Auth::id();
    }
}