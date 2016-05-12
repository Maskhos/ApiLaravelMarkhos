<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class factions extends Model
{
  protected $fillable = [
      'id','facname','facdescription','facshortdescription'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'facerased','created_at','updated_at'
  ];
}
