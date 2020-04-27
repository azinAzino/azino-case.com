<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    protected $fillable = ['user_id', 'manager_id', 'text', 'direction', 'status', 'ip'];


    public function manager()
    {
        return $this->belongsTo('App\User', 'manager_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function attachments()
    {
        return $this->hasMany('App\TicketAttachment', 'ticket_id');
    }
}
