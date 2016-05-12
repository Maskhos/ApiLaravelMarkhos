<?php

namespace App\Repositories;



use App\categorys;

class CategoryRepository
{

  /**
   * Get all of the tasks for a given user.
   *
   * @param  User  $user
   * @return Collection
   */
   public function All()
   {
       return categorys::where('caterased',false)->get();
   }
   public function create($request){

     return categorys::create($request->all());
   }
   /**
    * Get all of the tasks for a given user.
    *
    * @param  User  $user
    * @return Collection
    */

   public function show($pos)
   {
       return categorys::where('id', $pos)->where('caterased',false)->get();
   }

}
