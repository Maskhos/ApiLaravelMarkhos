<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Classe de la tabla factionstranslations
 */
class factionstranslations extends Model
{
  protected $fillable = [
    'id','language'
  ];

  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $hidden = [
    'created_at','updated_at','caterased'
  ];
}
