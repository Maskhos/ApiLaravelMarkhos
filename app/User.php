<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
/**
 * Classe de la tabla User
 */
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','remember_token','uspicture','password','usname','usbirthDate','country_id','usadmin','userased','ustwitter','ustwitter','usinstagram','faction_id','ustumblr','usdesc','email','uspassword'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
     'created_at','updated_at'
    ];
    public function factions()
    {
      // 1 usuari te una facio.
      // $this hace referencia al objeto que tengamos en ese momento de Avión.
      return $this->belongsTo('App\factions',"faction_id","id");
    }
    public function countrys()
    {
      // 1 usuari te una facio.
      // $this hace referencia al objeto que tengamos en ese momento de Avión.
      return $this->belongsTo('App\countrys',"country_id","id");
    }

}
