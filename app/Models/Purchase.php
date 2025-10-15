<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['item_id', 'quantity', 'buy_price', 'total_cost', 'purchase_date'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
