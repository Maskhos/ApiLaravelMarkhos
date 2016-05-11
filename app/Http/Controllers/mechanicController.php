<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\MechanicRepository;
class mechanicController extends Controller
{

    protected $mechanic;

   public function __construct(MechanicRepository $mechanic)
   {
     //$this->middleware('auth');
     //var_dump($factions);
     $this->mechanic = $mechanic;
   }

   public function index(Request $request)
     {
       echo json_encode($this->mechanic->All());
       //var_dump($this->factions->All());
         /*return view('faction.index', [
             'faction' => $this->factions->All() ,
         ]);*/
     }
}
