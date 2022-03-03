<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giveaway extends Model
{
    use HasFactory;
    protected $fillable =
        [
            'user_id',
            'amount',
            'no_of_winner',
            'end_at'
        ];

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
     return $this->belongsTo(User::class);
    }

    public function participation(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Participation::class);
    }
}
