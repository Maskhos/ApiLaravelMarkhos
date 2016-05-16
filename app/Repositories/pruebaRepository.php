<?php

namespace App\Repositories;



use App\prueba;

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
class PruebaRepository
{
  /**
   * Get all of the tasks for a given user.
   *
   * @param  User  $user
   * @return Collection
   */
  public function All()
  {
      return prueba::get();
  }

  public function show($pos)
  {
      return prueba::get();
  }

  public function create($request){



    $img = Image::make($request->file('image'));



    return prueba::create([
      'name' => $request->name,
      'image' => $img->encode('jpeg')
    ]);
  }
}
