<?php

namespace App\Repositories;



use App\mechanics;

class MechanicRepository
{

    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function All()
    {
        return mechanics::get();
    }
    public function show($id)
    {
        return mechanics::where('mecid', $id)->get();
    }
}
