<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'address',
        'lat',
        'long'
    ];


    public function foods(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Food::class);
    }
}
