<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;
    public function order(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
