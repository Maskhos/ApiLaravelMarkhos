<?php

namespace App\Repositories;



use App\mechanics;

class MechanicRepository
{
  /**
   * Get all of the tasks for a given user.
   *
   * @param  User  $user
   * @return Collection
   */
  public function All()
  {
      return mechanics::where('mecerased',false)->get();
  }
  public function create($request){

    return mechanics::create($request->all());
  }
  /**
   * Get all of the tasks for a given user.
   *
   * @param  User  $user
   * @return Collection
   */

  public function show($pos)
  {
      return mechanics::where('id', $pos)->where('mecerased',false)->get();
  }
}
