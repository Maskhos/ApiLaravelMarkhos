<?php

namespace App\Repositories;



use App\historys;

class HistoryRepository
{

    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function All()
    {
        return historys::get();
    }
}
