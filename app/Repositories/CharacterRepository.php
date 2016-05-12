<?php

namespace App\Repositories;



use App\characters;

class CharacterRepository
{

    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
     public function All()
     {
         return characters::where('charerased',false)->get();
     }
     public function create($request){

       return characters::create($request->all());
     }
     /**
      * Get all of the tasks for a given user.
      *
      * @param  User  $user
      * @return Collection
      */

     public function show($pos)
     {
         return characters::where('id', $pos)->where('charerased',false)->get();
     }
}
