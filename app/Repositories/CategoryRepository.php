<?php

namespace App\Repositories;



use App\categorys;

class CategoryRepository
{

    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function All()
    {
        return categorys::get();
    }
    
}
