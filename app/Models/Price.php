<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    protected $fillable =
        [
            'food_id',
            'price'
        ];
    public function food(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Food::class);
    }
}
