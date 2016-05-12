<?php

namespace App\Repositories;



use App\countrys;

class CountryRepository
{

  public function All()
  {
      return countrys::where('couerased',false)->get();
  }
  public function create($request){

    return countrys::create($request->all());
  }
  /**
   * Get all of the tasks for a given user.
   *
   * @param  User  $user
   * @return Collection
   */

  public function show($pos)
  {
      return countrys::where('id', $pos)->where('couerased',false)->get();
  }
}
