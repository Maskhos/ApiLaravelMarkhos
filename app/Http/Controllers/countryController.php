<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CountryRepository;
use App\Http\Requests;

class countryController extends Controller
{
  protected $countrys;

 public function __construct(CountryRepository $countrys)
 {
   //$this->middleware('auth');
   //var_dump($factions);
   $this->countrys = $countrys;
 }

 public function index(Request $request)
   {
     echo json_encode($this->countrys->All());
     //var_dump($this->factions->All());
       /*return view('faction.index', [
           'faction' => $this->factions->All() ,
       ]);*/
   }
}
