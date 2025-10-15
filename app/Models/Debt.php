<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    protected $fillable = [
        'debtor_name',
        'description',
        'amount',
        'debt_date',
        'due_date',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'debt_date' => 'date',
        'due_date' => 'date',
    ];
}
