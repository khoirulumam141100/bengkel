<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'description', 'price'];

    public function serviceSales()
    {
        return $this->hasMany(ServiceSale::class);
    }
}
