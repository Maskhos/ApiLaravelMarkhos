<?php

namespace App\Repositories;



use App\comments;

class CommentRepository
{

  public function All()
  {
      return comments::where('comerased',false)->get();
  }
  public function create($request){

    return comments::create($request->all());
  }
  /**
   * Get all of the tasks for a given user.
   *
   * @param  User  $user
   * @return Collection
   */

  public function show($pos)
  {
      return comments::where('id', $pos)->where('comerased',false)->get();
  }
  public function showCommentsPost($pos){

    return comments::where('post_id', $pos)->where('comerased',false)->get();
  }
}
