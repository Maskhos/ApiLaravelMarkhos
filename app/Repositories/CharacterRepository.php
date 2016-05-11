<?php

namespace App\Repositories;



use App\characters;

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
        return characters::get();
    }
}
