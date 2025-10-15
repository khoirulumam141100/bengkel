<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSale extends Model
{
    protected $fillable = ['service_id', 'quantity', 'price', 'total_revenue', 'service_date'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
