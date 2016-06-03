<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Classe de la tabla comments
 */
class comments extends Model
{
  protected $fillable = [
    'id','comcontent','user_id','post_id', 'editable',
  ];

  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $hidden = [
    'created_at','updated_at','comerased'
  ];
  public function users()
  {
    // 1 avión pertenece a un Fabricante.
    // $this hace referencia al objeto que tengamos en ese momento de Avión.
    return $this->belongsTo('App\User',"user_id","id");
  }
  public function posts()
  {
    // 1 avión pertenece a un Fabricante.
    // $this hace referencia al objeto que tengamos en ese momento de Avión.
    return $this->belongsTo('App\Post',"post_id","id");
  }
}
