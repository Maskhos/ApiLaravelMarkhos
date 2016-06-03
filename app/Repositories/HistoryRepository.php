<?php

namespace App\Repositories;


use App\historystranslations;
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
  /**
  * Get all of the tasks for a given user.
  *
  * @param  User  $user
  * @return Collection
  */
  public function AllLAN($lang)
  {
    return historystranslations::where('language',$lang)->get();
  }
  /**
   * Metodo que se encarga de contactar con la bd y crear un usuario
   * @param  [type] $request Contenido del cliente
   * @return [type]          se pasa el ultimo objeto creado
   */
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
    return historys::where('id', $pos)->where('hiserased',false)->first();
  }
}
