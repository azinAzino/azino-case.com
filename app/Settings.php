<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';
    protected $fillable = ['vk_group', 'vk_token', 'min_dep', 'min_width', 'ref_percent', 'payment_type', 'fk_id', 'fk_secret1', 'fk_secret2', 'pt_shopid', 'pt_secret'];
}
