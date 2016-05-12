<?php

namespace App\Repositories;



use App\User;

class UserRepository
{

    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function All()
    {
        return User::where('userased',false)->get();
    }
    public function create($request){

      return User::create($request->all());
    }
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */

    public function show($user)
    {
        return User::where('id', $user)->where('userased',false)->get();
    }
}
