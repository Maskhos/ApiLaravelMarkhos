<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class countrys extends Model
{
  protected $fillable = [
    'id','couname'
  ];

  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $hidden = [
    'couerased','created_at','updated_at'
  ];
}
