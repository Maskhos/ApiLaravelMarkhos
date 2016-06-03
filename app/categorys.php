<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Classe de la tabla categorys
 */
class categorys extends Model
{

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */


  protected $fillable = [
    'id','catname'
  ];

  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $hidden = [
    'created_at','updated_at','caterased'
  ];
  public function translations()
  {
    // 1 avión pertenece a un Fabricante.
    // $this hace referencia al objeto que tengamos en ese momento de Avión.
    return $this->hasMany('App\categorystranslations','category_id');
  }
}
