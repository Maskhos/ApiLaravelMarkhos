<?php

namespace App\Repositories;


use App\categorystranslations;
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
  /**
   * Metodo que se encarga de contactar con la bd y crear un usuario
   * @param  [type] $request Contenido del cliente
   * @return [type]          se pasa el ultimo objeto creado
   */
  public function create($request){

    return categorys::create($request->all());
  }
  /**
   * Metodo que se encarga  pedir los usuarios segun el idioma
   * @return [type]          JSON on todo el contenido
   */
  public function AllLAN($lang)
  {
    return categorystranslations::where('language',$lang)->join('categorys', 'categorys.id', '=', 'category_id')->select('categorys.id', 'categorystranslations.catname')->get();
  }


  /**
  * Get all of the tasks for a given user.
  *
  * @param  User  $user
  * @return Collection
  */

  public function show($pos)
  {
    return categorys::where('id', $pos)->where('caterased',false)->first();
  }
  /**
   * Mostrar todo el contenido por identificador e idioma
   * @param  [type] $request Contenido del cliente
   * @return [type]          se pasa el ultimo objeto creado
   */
  public function showLang($pos, $lang){
    return categorystranslations::where('language',$lang)->where('category_id',$pos)->join('categorys', 'categorys.id', '=', 'category_id')->select('categorys.id', 'categorystranslations.catname')->first();
  }

}
