<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class faction extends Model
{
  protected $fillable = [
      'facid','facname','facdescription','facshortdescription'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'facid','created_at','updated_at'
  ];
}
