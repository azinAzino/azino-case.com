<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Site;
use App\SiteCardImage;

class Cards extends Model
{
    protected $fillable = ['name', 'cost', 'chance'];

    public function getImageAttribute()
    {
        return SiteCardImage::where('card_id', $this->id)->where('site_id', SITE_ID)->first()->image;
    }
    public function getItemImageAttribute()
    {
        return SiteCardImage::where('card_id', $this->id)->where('site_id', SITE_ID)->first()->item_image;
    }
}
