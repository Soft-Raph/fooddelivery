<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;
    protected $fillable =[
      'user_id',
      'status',
      'location',
      'data'
    ];
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function tracking(): \Illuminate\Database\Eloquent\Relations\hasOne
    {
        return $this->hasOne(Tracking::class);
    }
    public function food(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Food::class);
    }

    private static function generateUUID(): string
    {
        $uuid = Str::random(6);
        if (self::where('code',$uuid)->first()){
            self::generateUUID();
        }
        return $uuid;
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function($model) {
            $model->uuid = self::generateUUID();
        });
    }
}
