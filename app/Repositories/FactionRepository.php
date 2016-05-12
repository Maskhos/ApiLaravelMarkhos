<?php

namespace App\Repositories;



use App\factions;

class FactionRepository
{

  /**
   * Get all of the tasks for a given user.
   *
   * @param  User  $user
   * @return Collection
   */
  public function All()
  {
      return factions::where('facerased',false)->get();
  }
  public function create($request){

    return factions::create($request->all());
  }
  /**
   * Get all of the tasks for a given user.
   *
   * @param  User  $user
   * @return Collection
   */

  public function show($pos)
  {
      return factions::where('id', $pos)->where('facerased',false)->get();
  }
}
