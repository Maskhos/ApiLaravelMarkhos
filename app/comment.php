<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
  protected $fillable = [
      'comcomment','user_id','post_id',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'comid','created_at','updated_at'
  ];
  public function user()
  {
    // 1 avión pertenece a un Fabricante.
    // $this hace referencia al objeto que tengamos en ese momento de Avión.
    return $this->belongsTo('App\User');
  }
}
