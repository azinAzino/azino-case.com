<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Site;
use App\SiteCardImage;
use Illuminate\Support\Facades\App;

class Cards extends Model
{
    protected $fillable = ['cost', 'chance'];

    public function getImageAttribute()
    {
        return SiteCardImage::where('card_id', $this->id)->where('site_id', SITE_ID)->first()->image;
    }
    public function getItemImageAttribute()
    {
        return SiteCardImage::where('card_id', $this->id)->where('site_id', SITE_ID)->first()->item_image;
    }
    public function getLangNameAttribute()
    {
        $name = SiteCardName::where('site_id', SITE_ID)->where('card_id', $this->id)->where('language_id', App::getLocale())->first();
        return $name ? $name->name : $this->name;
    }
}
