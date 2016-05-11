<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class countrys extends Model
{
  protected $fillable = [
    'couid','couname'
  ];

  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $hidden = [
    'created_at','updated_at'
  ];
}
