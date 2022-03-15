<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
protected $casts = [
  'created_at'=>'datetime'
];

    protected $fillable = [
        'name',
        'address',
        'lat',
        'long',
        'state',
        'city',
        'country',
    ];


    public function food(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Food::class);
    }
}
