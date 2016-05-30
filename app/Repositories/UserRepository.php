<?php

namespace App\Repositories;



use Hash;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
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
    return User::where('userased',false)->with("factions")->get();
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
      return User::where('id', $user)->with("factions")->where('userased',false)->get();
    }
    public function retrieveByToken($identifier, $token)
    {

      $user = User::where('id', $identifier)
      ->where('remember_token', $token)
      ->first();

      return $this->getGenericUser($user);
    }

    /**
    * Update the "remember me" token for the given user in storage.
    *
    * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
    * @param  string  $token
    * @return void
    */
    public function updateRememberToken($id, $token)
    {

      return User::where('id', $id)
      ->update(['remember_token' => $token])->get();
    }

    /**
    * Retrieve a user by the given credentials.
    *
    * @param  array  $credentials
    * @return \Illuminate\Contracts\Auth\Authenticatable|null
    */
    public function retrieveByCredentials(array $credentials)
    {
      // First we will add each credential element to the query as a where clause.
      // Then we can execute the query and, if we found a user, return it in a
      // generic "user" object that will be utilized by the Guard instances.
      $query = null;

      foreach ($credentials as $key => $value) {
        if (! Str::contains($key, 'password')) {
          $query = User::where($key, $value)->get();
        }
      }

      // Now we are ready to execute the query to see if we have an user matching
      // the given credentials. If not, we will just return nulls and indicate
      // that there are no matching users for these given credential arrays.
      $user = $query->first();

      return $user;
    }

    /**
    * Get the generic user.
    *
    * @param  mixed  $user
    * @return \Illuminate\Auth\GenericUser|null
    */
    protected function getGenericUser($user)
    {
      if ($user !== null) {
        return new GenericUser((array) $user);
      }
    }

    /**
    * Validate a user against the given credentials.
    *
    * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
    * @param  array  $credentials
    * @return bool
    */
    public function validateCredentials($id, array $credentials)
    {
      $user = User::where('id', $id)
      ->where('remember_token', $token)
      ->first();

      $plain = $credentials['password'];

      return Hash::check($plain, $user->password);
    }
  }
