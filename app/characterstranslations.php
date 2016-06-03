<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Classe de la tabla characterstranslations
 */
class characterstranslations extends Model
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
  public function factions()
  {
    // 1 usuari te una facio.
    // $this hace referencia al objeto que tengamos en ese momento de Avión.
    return $this->belongsTo('App\factions',"faction_id","id");
  }
}
