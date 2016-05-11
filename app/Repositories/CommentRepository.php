<?php

namespace App\Repositories;



use App\comments;

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
        return comments::get();
    }
}
