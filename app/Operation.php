<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    protected $fillable = [
        'amount',
        'user',
        'type',
        'status',
        'ref_user',
        'timestamp',
        'koshelek',
        'nomer',
        'swift',
        'tax',
        'is_swift',
        'is_tax',
        'is_fake',
        'operation',
    ];
}
