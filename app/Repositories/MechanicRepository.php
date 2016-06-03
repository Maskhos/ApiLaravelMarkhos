<?php

namespace App\Repositories;



use App\mechanics;
use App\mechanicstranslations;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
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
    $mechanics =  mechanics::where('mecerased',false)->get();
    for ($i=0; $i < count($mechanics); $i++) {
      if($mechanics[$i]->mecpicture != null){
        $img = Image::make($mechanics[$i]->mecpicture);
        $mechanics[$i]->mecpicture =  base64_encode($img->encode('png'));
      }
    }
    return $mechanics;
  }
  /**
   * Metodo que se encarga  pedir los usuarios segun el idioma
   * @return [type]          JSON on todo el contenido
   */
  public function AllLAN($lang){
    $mechanics =  mechanicstranslations::where('language',$lang)->join('mechanics', 'mechanics.id', '=', 'mechanic_id')->select('mechanics.*', 'mechanicstranslations.mectitle','mechanicstranslations.mecdescription' )->get();
    for ($i=0; $i < count($mechanics); $i++) {
      if($mechanics[$i]->mecpicture != null){
        $img = Image::make($mechanics[$i]->mecpicture);
        $mechanics[$i]->mecpicture =  base64_encode($img->encode('png'));
      }
    }
    return $mechanics;
  }
  /**
   * Metodo que se encarga de contactar con la bd y crear un usuario
   * @param  [type] $request Contenido del cliente
   * @return [type]          se pasa el ultimo objeto creado
   */
  public function create($request){

    $mechanics =  mechanics::create($request->all());

    return $mechanics;
  }
  /**
  * Get all of the tasks for a given user.
  *
  * @param  User  $user
  * @return Collection
  */

  public function show($pos)
  {
    $mechanic =  mechanics::where('id', $pos)->where('mecerased',false)->first();
    if($mechanic !=null){
      $img = Image::make($mechanic->mecpicture);
      $mechanic->mecpicture =  base64_encode($img->encode('png'));
    }
    return $mechanic;
  }
}
