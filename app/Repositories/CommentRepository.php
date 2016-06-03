<?php

namespace App\Repositories;



use App\comments;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
class CommentRepository
{
  /**
  * Get all of the tasks for a given user.
  *
  * @param  User  $user
  * @return Collection
  */
  public function All()
  {
    $comments = comments::where('comerased',false)->orderBy('created_at', 'desc')->with("users")->get();
    for ($i=0; $i < count($comments); $i++) {
      if($comments[$i]["users"]->uspicture !=null){
        $img2 = Image::make($comments[$i]["users"]->uspicture);
        $comments[$i]["users"]->uspicture = base64_encode($img2->encode('png'));
      }
    }
    return $comments;
  }
  /**
   * Metodo que se encarga de contactar con la bd y crear un usuario
   * @param  [type] $request Contenido del cliente
   * @return [type]          se pasa el ultimo objeto creado
   */
  public function create($request){

    return comments::create([
      'comcontent' =>  $request->comcontent,
      'user_id' => $request->user_id,
      'post_id' => $request->post_id,

    ]);
  }
  /**
  * Get all of the tasks for a given user.
  *
  * @param  User  $user
  * @return Collection
  */

  public function show($pos)
  {
    $comments =  comments::where('id', $pos)->where('comerased',false)->with("users")->first();
    if($comments["users"]->uspicture !=null){
      $img2 = Image::make($comments["users"]->uspicture);
      $comments["users"]->uspicture = base64_encode($img2->encode('png'));
    }
    return $comments;
  }
  /**
   * Metodo que se encarga de mostrar los comentarios con sus posts
   * @param  [type] $pos identificador
   * @return [type]      [description]
   */
  public function showCommentsPost($pos){

    $comments= comments::where('post_id', $pos)->where('comerased',false)->orderBy('created_at', 'desc')->with("users")->get();
    if($comments !=null){
      for ($i=0; $i < count($comments); $i++) {
        if($comments[$i]["users"]->uspicture !=null){
          $img2 = Image::make($comments[$i]["users"]->uspicture);
          $comments[$i]["users"]->uspicture = base64_encode($img2->encode('png'));
        }
      }
    }
    return $comments;
  }
}
