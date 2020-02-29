<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
	protected $fillable = ['card', 'image', 'cost', 'type'];
}
