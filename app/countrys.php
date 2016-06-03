<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Classe de la tabla countrys
 */
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
