<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sales extends Model
{
    use HasFactory;
    protected $fillable = [
        'bar_code',
        'quantity',
        'item_price',
        'item_discount',
        'total',
        'credit',
        'shop_id',
        'customer_id',
        'bill_id',
    ];

    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class,'barcode_no', 'barcode');
    }
     public function shop(): BelongsTo
    {
        return $this->belongsTo(Shops::class,'shop_id', 'id');
    }
     public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class,'customer_id', 'id');
    }
 public function bill(): BelongsTo
    {
        return $this->belongsTo(Bill::class,'bill_id', 'bill_no');
    }


}
