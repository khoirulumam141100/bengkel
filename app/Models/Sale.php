<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['item_id', 'quantity', 'sell_price', 'total_revenue', 'sale_date'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
