<?php

namespace App\Repositories;



use App\characters;
use App\characterstranslations;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
class CharacterRepository
{

  /**
  * Get all of the tasks for a given user.
  *
  * @param  User  $user
  * @return Collection
  */
  public function All()
  {
    $array =  characters::where('charerased',false)->get();

    for ($i=0; $i < count($array); $i++) {
      $img = Image::make($array[$i]->charportrait);
      //  $characters[$i]->charportrait =  base64_encode($img->encode('jpeg'));

      $array[$i]->charportrait =  base64_encode($img->encode('png'));
      if($array[$i]->charfacechar !=null){
        $img = Image::make($array[$i]->charfacechar);

        $array[$i]->charfacechar = base64_encode($img->encode('png'));

      }

      if($array[$i]->charspoilerimage !=null){
        $img2 = Image::make($array[$i]->charspoilerimage);
        $array[$i]->charspoilerimage = base64_encode($img2->encode('png'));
      }
    }
    return $array;
  }
  /**
   * Metodo que se encarga  pedir los usuarios segun el idioma
   * @return [type]          JSON on todo el contenido
   */
  public function AllLAN($lang)
  {
    $array =  characterstranslations::where('language',$lang)->join('characters', 'characters.id', '=', 'character_id')->select('characters.*', 'characterstranslations.charbio','characterstranslations.charclass','characterstranslations.charstylecombat' )->get();

    for ($i=0; $i < count($array); $i++) {
      $img = Image::make($array[$i]->charportrait);
      //  $characters[$i]->charportrait =  base64_encode($img->encode('jpeg'));

      $array[$i]->charportrait =  base64_encode($img->encode('png'));
      if($array[$i]->charfacechar !=null){
        $img = Image::make($array[$i]->charfacechar);

        $array[$i]->charfacechar = base64_encode($img->encode('png'));

      }

      if($array[$i]->charspoilerimage !=null){
        $img2 = Image::make($array[$i]->charspoilerimage);
        $array[$i]->charspoilerimage = base64_encode($img2->encode('png'));
      }
    }
    return $array;
  }
  /**
   * Metodo que se encarga de contactar con la bd y crear un usuario
   * @param  [type] $request Contenido del cliente
   * @return [type]          se pasa el ultimo objeto creado
   */
  public function create($request){

    $character = characters::create($request->all());
    return $character;
  }
  /**
  * Get all of the tasks for a given user.
  *
  * @param  User  $user
  * @return Collection
  */

  public function show($pos)
  {

    $character =  characters::where('id', $pos)->with("factions")->where('charerased',false)->first();
    if($character !=null){
      $img = Image::make($character->charportrait);
      //  $characters[$i]->charportrait =  base64_encode($img->encode('jpeg'));

      $character->charportrait =  base64_encode($img->encode('png'));
      if($character->charfacechar !=null){
        $img2 = Image::make($character->charfacechar);
        $character->charfacechar = base64_encode($img2->encode('png'));
      }

      if($character->charspoilerimage !=null){
        $img3 = Image::make($character->charspoilerimage);
        $character->charspoilerimage = base64_encode($img3->encode('png'));
      }
      if($character["factions"] !=null){
        $img4 = Image::make($character["factions"]->facphoto);
        $character["factions"]->facphoto = base64_encode($img4->encode('png'));
      }
    }
    return $character;
  }
  /**
   * Mostrar todo el contenido por identificador e idioma
   * @param  [type] $request Contenido del cliente
   * @return [type]          se pasa el ultimo objeto creado
   */
  public function showLAN($pos, $lang){
    $character =  characterstranslations::where('language',$lang)->where('character_id',$pos)->with("factions")->join('characters', 'characters.id', '=', 'character_id')->select('characters.*', 'characterstranslations.charbio','characterstranslations.charclass','characterstranslations.charstylecombat' )->first();
    if($character !=null){
      $img = Image::make($character->charportrait);
      //  $characters[$i]->charportrait =  base64_encode($img->encode('jpeg'));

      $character->charportrait =  base64_encode($img->encode('png'));
      if($character->charfacechar !=null){
        $img2 = Image::make($character->charfacechar);
        $character->charfacechar = base64_encode($img2->encode('png'));
      }

      if($character->charspoilerimage !=null){
        $img3 = Image::make($character->charspoilerimage);
        $character->charspoilerimage = base64_encode($img3->encode('png'));
      }
      if($character["factions"] !=null){
        $img4 = Image::make($character["factions"]->facphoto);
        $character["factions"]->facphoto = base64_encode($img4->encode('png'));
      }
    }
    return $character;
  }
}
