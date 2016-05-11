<?php

namespace App\Repositories;



use App\countrys;

class CountryRepository
{

    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function All()
    {
        return countrys::get();
    }
}
