<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketTemplate extends Model
{
    //
    protected $fillable = ['title', 'ticket_category_id', 'text'];

    public function category()
    {
        return $this->belongsTo('App\TicketCategory', 'ticket_category_id');
    }
}
