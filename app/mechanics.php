<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mechanics extends Model
{
  protected $fillable = [
      'mectitle','mecdescription','mecpicture','mecvideo',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'mecid','created_at','updated_at'
  ];
}
