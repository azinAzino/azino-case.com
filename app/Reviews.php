<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $fillable = ['username', 'user_link', 'user_avatar', 'text', 'photo', 'opinion_link'];
}
