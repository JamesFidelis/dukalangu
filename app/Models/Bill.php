<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bill extends Model
{
    use HasFactory;
    protected $fillable = [
        'bill_no',
        'customer_id',
        'customer_names',
        'shop_id',
        'normal_price',
        'discount_price',
        'quantity',
        'total',
        'isPaid',
    ];


    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class,'customer_id', 'id');
    }
    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shops::class,'shop_id', 'id');
    }
    public function sales(): HasOne
    {
        return $this->hasOne(Sales::class,'bill_id', 'bill_no');
    }


}
