<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class history extends Model
{
  protected $fillable = [
      'hisid','histitle','hisdescription','hisDateEvent','hisshortDescription',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'hisid','created_at','updated_at'
  ];
}
