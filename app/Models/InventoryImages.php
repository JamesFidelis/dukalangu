<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_id',
        'image_path'
    ];




    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class,'inventory_id', 'id');
    }
}
