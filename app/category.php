<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{

      /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
      protected $fillable = [
          'catname'
      ];

      /**
       * The attributes that should be hidden for arrays.
       *
       * @var array
       */
      protected $hidden = [
          'catid','created_at','updated_at'
      ];
}
