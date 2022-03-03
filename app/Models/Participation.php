<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    use HasFactory;

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function giveaways(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Giveaway::class);
    }


}
