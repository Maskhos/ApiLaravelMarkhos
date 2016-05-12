<?php

namespace App\Repositories;



use App\historys;

class HistoryRepository
{

  /**
   * Get all of the tasks for a given user.
   *
   * @param  User  $user
   * @return Collection
   */
  public function All()
  {
      return historys::where('hiserased',false)->get();
  }
  public function create($request){

    return historys::create($request->all());
  }
  /**
   * Get all of the tasks for a given user.
   *
   * @param  User  $user
   * @return Collection
   */

  public function show($pos)
  {
      return historys::where('id', $pos)->where('hiserased',false)->get();
  }
}
