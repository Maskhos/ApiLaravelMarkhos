<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


use App\Repositories\UserRepository;
class UserController extends Controller
{
  protected $user;

 public function __construct(UserRepository $user)
 {
   //$this->middleware('auth');
   //var_dump($factions);
   $this->user = $user;
 }

 public function index(Request $request)
   {
     echo json_encode($this->user->All());
     //var_dump($this->factions->All());
       /*return view('faction.index', [
           'faction' => $this->factions->All() ,
       ]);*/
   }
   public function show($user)
     {
       echo json_encode($this->user->show($user));
       //var_dump($this->factions->All());
         /*return view('faction.index', [
             'faction' => $this->factions->All() ,
         ]);*/
     }
     public function store(User $user){
       
     }
}
