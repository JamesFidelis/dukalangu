<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shops extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_name',
        'location',
        'incharge_id',
        'owner_id',
    ];


    public function ownerUser(): BelongsTo
    {
        return $this->belongsTo(User::class,'owner_id', 'id');
    }


    public function userIncharge(): BelongsTo
    {
        return $this->belongsTo(User::class, 'incharge_id', 'id');
    }

    public function inventory(): HasMany
    {
        return $this->hasMany(Inventory::class,'shop_id', 'id');
    }

//    public function categories(): HasMany
//    {
//        return $this->hasMany(Category::class,'category_id', 'id');
//    }

    public function bills(): HasMany
    {
        return $this->hasMany(Bill::class,'shop_id', 'id');
    }

    public function customer(): HasMany
    {
        return $this->hasMany(User::class,'shop_id', 'id');
    }
    public function sales(): HasMany
    {
        return $this->hasMany(Sales::class,'shop_id', 'id');
    }


}
