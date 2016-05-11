<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Repositories\CharacterRepository;

class characterController extends Controller
{
  protected $characters;

  function __construct(CharacterRepository $characters){
      $this->characters = $characters;
  }
  public function index(Request $request)
  {
    echo json_encode($this->characters->All());
    //var_dump($this->factions->All());
    /*return view('faction.index', [
    'faction' => $this->factions->All() ,
  ]);*/
}
}
