<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\FactionRepository;
class factionController extends Controller
{
   protected $factions;

  public function __construct(FactionRepository $factions)
  {
    //$this->middleware('auth');
    //var_dump($factions);
    $this->factions = $factions;
  }

  public function index(Request $request)
    {
      echo json_encode($this->factions->All());
      //var_dump($this->factions->All());
        /*return view('faction.index', [
            'faction' => $this->factions->All() ,
        ]);*/
    }
}
