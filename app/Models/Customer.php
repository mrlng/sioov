<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    protected $guarded = [];
    public function items() : BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
