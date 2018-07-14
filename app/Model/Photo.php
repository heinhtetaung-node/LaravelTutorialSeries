<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
	protected $table = "photos";

    protected $fillable = ['photoname', 'description'];
}
