<?php

namespace App\Repositories;



use App\posts;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
class PostRepository
{
  public function limitBy($limit){
    return posts::where('poserased',false)->orderBy('created_at', 'desc')
    ->take($limit)->get();

  }
  /**
  * Get all of the tasks for a given user.
  *
  * @param  User  $user
  * @return Collection
  */
  public function All()
  {

    return posts::where('poserased',false)->orderBy('created_at', 'desc')->get();
  }
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

  public function show($pos)
  {
    return posts::where('id', $pos)->where('poserased',false)->get();
  }
}
