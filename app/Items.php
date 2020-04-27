<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
	protected $fillable = ['card', 'cost', 'type'];

    public function getImageAttribute()
    {
        return SiteItemImage::where('item_id', $this->id)->where('site_id', SITE_ID)->first()->image;
    }
}
