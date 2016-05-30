<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
  protected $fillable = [
    'id','user_id','postitle','posdescription','poscontent','posphoto','posdate','posshortdesc','poserased','category_id','created_at'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'posid','updated_at'
  ];
  public function users()
  {
    // 1 avión pertenece a un Fabricante.
    // $this hace referencia al objeto que tengamos en ese momento de Avión.
    return $this->belongsTo('App\User','user_id','id');
  }
  public function categorys()
  {
    // 1 avión pertenece a un Fabricante.
    // $this hace referencia al objeto que tengamos en ese momento de Avión.
    return $this->belongsTo('App\categorys','category_id','id');
  }
  public function comments()
  {
    // 1 avión pertenece a un Fabricante.
    // $this hace referencia al objeto que tengamos en ese momento de Avión.
    return $this->hasMany('App\comments','post_id');
  }
}
