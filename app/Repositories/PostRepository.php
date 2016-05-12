<?php

namespace App\Repositories;



use App\posts;

class PostRepository
{
  /**
   * Get all of the tasks for a given user.
   *
   * @param  User  $user
   * @return Collection
   */
  public function All()
  {
      return posts::where('poserased',false)->get();
  }
  public function create($request){

    return posts::create($request->all());
  }
  /**
   * Get all of the tasks for a given user.
   *
   * @param  User  $user
   * @return Collection
   */

  public function show($pos)
  {
      return posts::where('id', $pos)->where('poserased',false)->get();
  }
}
