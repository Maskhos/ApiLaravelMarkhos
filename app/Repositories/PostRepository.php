<?php

namespace App\Repositories;



use App\posts;

class PostRepository
{

    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function All()
    {
        return posts::get();
    }
    public function show($post)
    {
        return User::where('posid', $user)->get();
    }
}
