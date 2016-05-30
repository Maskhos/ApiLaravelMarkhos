<?php

namespace App\Repositories;



use App\comments;

class CommentRepository
{

  public function All()
  {
      return comments::where('comerased',false)->orderBy('created_at', 'desc')->with("users")->get();
  }
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
      return comments::where('id', $pos)->where('comerased',false)->with("users")->get();
  }
  public function showCommentsPost($pos){

    return comments::where('post_id', $pos)->where('comerased',false)->orderBy('created_at', 'desc')->with("users")->get();
  }
}
