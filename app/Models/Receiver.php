<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    use HasFactory;

    public function giver(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Giver::class);
    }
}
