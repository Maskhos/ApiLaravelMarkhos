<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Classe de la tabla historys
 */
class historys extends Model
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
