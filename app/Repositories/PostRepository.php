<?php

namespace App\Repositories;



use App\posts;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
class PostRepository
{
  /**
   * Metodo para sacar el contenido de la bd de forma paginada  segun el size
   * @param  [type] $size tamaño de filtro de paginacion
   * @return [type]       Devuelve un array con contenido paginado
   */
  public function byPages($size){
    $posts = posts::where('poserased',false)->with('users')->with('categorys')->simplePaginate($size); // Now list that one column;
    for ($i=0; $i < count($posts); $i++) {
      $img1 = Image::make($posts[$i]->posphoto);
      $img2 = Image::make($posts[$i]["users"]->uspicture);

      $posts[$i]->posphoto =  base64_encode($img1->encode('png'));
      $posts[$i]["users"]->uspicture = base64_encode($img2->encode('png'));
    }
    return $posts;
  }
  /**
   * Metodo que devuelve los posts segun su categoria segun identificador
   * @param  [type] $id identificador
   * @return [type]     [description]
   */
  public function bycategory($id){
    $posts = posts::where('poserased',false)->where("category_id",$id)->with('users')->with('categorys')->get(); // Now list that one column;
    for ($i=0; $i < count($posts); $i++) {
      $img1 = Image::make($posts[$i]->posphoto);
      $img2 = Image::make($posts[$i]["users"]->uspicture);

      $posts[$i]->posphoto =  base64_encode($img1->encode('png'));
      $posts[$i]["users"]->uspicture = base64_encode($img2->encode('png'));
    }
    return $posts;
  }
  /**
   * Metodo que devuelve un numero limitado de posts
   * @param  [type] $id identificador
   * @return [type]     [description]
   */
  public function limitBy($limit){
    $posts =  posts::where('poserased',false)->orderBy('posdate', 'desc')->with('users')->with('categorys')->take($limit)->get();
    for ($i=0; $i < count($posts); $i++) {
      $img1 = Image::make($posts[$i]->posphoto);
      $img2 = Image::make($posts[$i]["users"]->uspicture);

      $posts[$i]->posphoto =  base64_encode($img1->encode('png'));
      $posts[$i]["users"]->uspicture = base64_encode($img2->encode('png'));
    }
    return $posts;
  }
  /**
  * Get all of the tasks for a given user.
  *
  * @param  User  $user
  * @return Collection
  */
  public function All()
  {
    $posts = posts::where('poserased',false)->with('users')->with('categorys')->get();
    for ($i=0; $i < count($posts); $i++) {
      $img1 = Image::make($posts[$i]->posphoto);
      $img2 = Image::make($posts[$i]["users"]->uspicture);

      $posts[$i]->posphoto =  base64_encode($img1->encode('png'));
      $posts[$i]["users"]->uspicture = base64_encode($img2->encode('png'));
    }
    return $posts;
    //return posts::where('poserased',false)->orderBy('posdate`', 'desc')->join('categorys as category', 'categorys.id', '=', 'category_id')->join('users', 'users.id', '=', 'user_id')->get(); // Now list that one column;
  }
  /**
   * Metodo que se encarga de contactar con la bd y crear un usuario
   * @param  [type] $request Contenido del cliente
   * @return [type]          se pasa el ultimo objeto creado
   */
  public function create($request){
    $img = Image::make($request->file('posphoto'));
    return posts::create([
      'posphoto' =>  $img->encode('jpeg'),
      'poscontent' => $request->poscontent,
      'posshortdesc' => $request->posshortdesc,
      'postitle' => $request->postitle,
      'category_id' => $request->category_id,
      'user_id' =>$request->user_id
    ]);
  }
  /**
  * Get all of the tasks for a given user.
  *
  * @param  User  $user
  * @return Collection
  */
  public function postWithComments($pos){
    $posts = posts::where('posts.id', $pos)->where('poserased',false)->with('users')->with('categorys')->with("comments")->get();
    for ($i=0; $i < count($posts); $i++) {
      $img1 = Image::make($posts[$i]->posphoto);
      $img2 = Image::make($posts[$i]["users"]->uspicture);

      $posts[$i]->posphoto =  base64_encode($img1->encode('png'));
      $posts[$i]["users"]->uspicture = base64_encode($img2->encode('png'));
    }
    return $posts;
  }
  /**
  * Get all of the tasks for a given user.
  *
  * @param  User  $user
  * @return Collection
  */

  public function show($pos)
  {
    $post =  posts::where('posts.id', $pos)->where('poserased',false)->with('users')->with('categorys')->first();
    if($post !=null){
      $img1 = Image::make($post->posphoto);
      $img2 = Image::make($post["users"]->uspicture);
      $post->posphoto =  base64_encode($img1->encode('png'));
      $post["users"]->uspicture = base64_encode($img2->encode('png'));
    }
    return $post;
  }
}
