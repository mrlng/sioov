<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $guarded = [''];
    public function items() : HasMany
    {
        return $this->hasMany(Item::class);
    }
    public function customer() : BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
