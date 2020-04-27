<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteCardImage extends Model
{
    //
    protected $table = 'site_card_image';
    protected $fillable = ['image', 'item_image', 'site_id', 'card_id'];
}
