<?php

namespace App\Repositories;



use Hash;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use App\User;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

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
    $users =  User::where('userased',false)->with("factions")->get();
    for ($i=0; $i < count($users); $i++) {
      if($users[$i]->uspicture!=null){
        $img = Image::make($users[$i]->uspicture);
        $users[$i]->uspicture =  base64_encode($img->encode('png'));

        //  }
      }
      $img2 = Image::make($users[$i]["factions"]->facphoto);
      $users[$i]["factions"]->facphoto =  base64_encode($img2->encode('png'));
    }
    return $users;
  }
  /**
  * Get all of the tasks for a given user.
  *
  * @param  User  $user
  * @return Collection
  */
  public function userFaction($faction)
  {
    $users =  User::where('userased',false)->where("faction_id", $faction)->with("countrys")->with("factions")->get();
    for ($i=0; $i < count($users); $i++) {
      if($users[$i]->uspicture!=null){
        $img = Image::make($users[$i]->uspicture);
        $users[$i]->uspicture =  base64_encode($img->encode('png'));

        //  }
      }
      $img2 = Image::make($users[$i]["factions"]->facphoto);
      $users[$i]["factions"]->facphoto =  base64_encode($img2->encode('png'));
    }
    return $users;
  }
  /**
   * Metodo que se encarga de contactar con la bd y crear un usuario
   * @param  [type] $request Contenido del cliente
   * @return [type]          se pasa el ultimo objeto creado
   */
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
    $user =  User::where('id', $user)->with("factions")->with("countrys")->where('userased',false)->first();
    if($user !=null){
      if($user->uspicture!=null){
        $img = Image::make($user->uspicture);
        $user->uspicture =  base64_encode($img->encode('png'));
      }
      $img2 = Image::make($user["factions"]->facphoto);
      $user["factions"]->facphoto =  base64_encode($img2->encode('png'));
    }
    return $user;
  }
  /**
   * Metodo que se encarga de buscar el usuario por token
   * @param  [type] $id    identificdor
   * @param  [type] $token token
   * @return [type]        Devuelve un json con el contenido
   */
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
