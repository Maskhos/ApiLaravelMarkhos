<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class characters extends Model
{

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'id','charname','charclass','charbio','charage','charportrait','charstylecombat','faction_id','charfacechar'
        ];

        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
             'created_at','updated_at','charerased'
        ];
        // Relación de Avión con Fabricante:
	public function faction()
	{
		// 1 avión pertenece a un Fabricante.
		// $this hace referencia al objeto que tengamos en ese momento de Avión.
		return $this->belongsTo('App\faction');
	}
}
