<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categorys extends Model
{

      /**
       * The attributes that are mass assignable.
       *
       * @var array
       */


      protected $fillable = [
            'catid','catname'
      ];

      /**
       * The attributes that should be hidden for arrays.
       *
       * @var array
       */
      protected $hidden = [
        'created_at','updated_at'
      ];
}
