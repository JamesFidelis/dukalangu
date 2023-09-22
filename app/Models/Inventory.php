<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable = [
        'barcode_no',
        'buy_price',
        'price_retail',
        'price_bulk',
        'quantity',
        'shop_id',
    ];


    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shops::class,'shop_id', 'id');
    }

    public function stock(): HasMany
    {
        return $this->hasMany(Stock::class, 'barcode_no', 'barcode');
    }
    public function sales(): HasMany
    {
        return $this->hasMany(Sales::class,'barcode_no', 'barcode');
    }


}
