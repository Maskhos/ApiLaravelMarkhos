<?php

namespace App\Repositories;

use App\factions;
use App\factionstranslations;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
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
    $factions =  factions::where('facerased',false)->get();
    for ($i=0; $i < count($factions); $i++) {
      if($factions[$i]->facphoto!=null){
        $img = Image::make($factions[$i]->facphoto);
        $factions[$i]->facphoto =  base64_encode($img->encode('png'));
      }
    }
    return $factions;
  }
  /**
   * Metodo que se encarga  pedir los usuarios segun el idioma
   * @return [type]          JSON on todo el contenido
   */
  public function AllLAN($lang){
    $factions =  factionstranslations::where('language',$lang)->join('factions', 'factions.id', '=', 'faction_id')->select('factions.*', 'factionstranslations.facname','factionstranslations.facdescription' )->get();
    for ($i=0; $i < count($factions); $i++) {
      if($factions[$i]->facphoto!=null){
        $img = Image::make($factions[$i]->facphoto);
        $factions[$i]->facphoto =  base64_encode($img->encode('png'));
      }
    }
    return $factions;


  }
  /**
   * Metodo que se encarga de contactar con la bd y crear un usuario
   * @param  [type] $request Contenido del cliente
   * @return [type]          se pasa el ultimo objeto creado
   */
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
    $faction =  factions::where('id', $pos)->where('facerased',false)->first();

    if($faction !=null){
      $img = Image::make($faction->facphoto);
      $faction->facphoto =  base64_encode($img->encode('png'));
    }
    return $faction;

  }
  /**
   * Mostrar todo el contenido por identificador e idioma
   * @param  [type] $request Contenido del cliente
   * @return [type]          se pasa el ultimo objeto creado
   */
  function showLAN($pos, $lang){
    $faction = factionstranslations::where('faction_id',$pos)->where("language",$lang)->join('factions', 'factions.id', '=', 'faction_id')->select('factions.*', 'factionstranslations.facname','factionstranslations.facdescription' )->first();
    if($faction !=null){
      $img = Image::make($faction->facphoto);
      $faction->facphoto =  base64_encode($img->encode('png'));
    }
    return $faction;
  }
}
