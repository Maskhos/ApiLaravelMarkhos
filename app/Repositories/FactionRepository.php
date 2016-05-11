<?php

namespace App\Repositories;



use App\factions;

class FactionRepository
{

    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function All()
    {
        return factions::get();
    }
}
