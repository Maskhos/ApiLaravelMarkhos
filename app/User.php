<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','remember_token','password','usname', 'uspicture','usbirthDate','country_id','usadmin','userased','ustwitter','ustwitter','usinstagram','faction_id','ustumblr','usdesc','email','uspassword'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
     'created_at','updated_at'
    ];
    public function faction()
    {
      // 1 usuari te una facio.
      // $this hace referencia al objeto que tengamos en ese momento de Avión.
      return $this->belongsTo('App\faction');
    }
}
