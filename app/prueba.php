<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class prueba extends Model
{
  protected $fillable = [
      'name','image'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'id'
  ];
}
