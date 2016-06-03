<?php

namespace App\Repositories;



use App\countrys;

class CountryRepository
{

  /**
  * Get all of the tasks for a given user.
  *
  * @param  User  $user
  * @return Collection
  */
  public function All()
  {
      return countrys::where('couerased',false)->orderBy('created_at', 'desc')->get();
  }
  /**
   * Metodo que se encarga de contactar con la bd y crear un usuario
   * @param  [type] $request Contenido del cliente
   * @return [type]          se pasa el ultimo objeto creado
   */
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
      return countrys::where('id', $pos)->where('couerased',false)->first();
  }
}
