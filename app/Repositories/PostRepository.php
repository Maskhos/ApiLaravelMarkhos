<?php

namespace App\Repositories;



use App\posts;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
class PostRepository
{
  public function bycategory($id){
    return posts::where('poserased',false)->where("category_id",$id)->with('users')->with('categorys')->get(); // Now list that one column;
  }
  public function limitBy($limit){
    return posts::where('poserased',false)->orderBy('posdate', 'desc')->with('users')->with('categorys')->take($limit)->get();

  }
  /**
  * Get all of the tasks for a given user.
  *
  * @param  User  $user
  * @return Collection
  */
  public function All()
  {
    return posts::where('poserased',false)->with('users')->with('categorys')->get();
    //return posts::where('poserased',false)->orderBy('posdate`', 'desc')->join('categorys as category', 'categorys.id', '=', 'category_id')->join('users', 'users.id', '=', 'user_id')->get(); // Now list that one column;
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
    return posts::where('posts.id', $pos)->where('poserased',false)->with('users')->with('categorys')->with("comments")->get();
  }
}
