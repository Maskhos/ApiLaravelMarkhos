<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class factions extends Model
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
      'created_at','updated_at'
  ];
}
