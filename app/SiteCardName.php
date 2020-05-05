<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteCardName extends Model
{

    protected $table = 'site_card_names';
    protected $fillable = ['name', 'language_id', 'site_id', 'card_id'];

    //
}
