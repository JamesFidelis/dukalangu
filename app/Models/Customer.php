<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'shop_id',
    ];


    public function bills(): HasMany
    {
        return $this->hasMany(Bill::class,'customer_id', 'id');
    }
    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shops::class,'shop_id', 'id');
    }
    public function sales(): BelongsTo
    {
        return $this->belongsTo(Customer::class,'customer_id', 'id');
    }

}
