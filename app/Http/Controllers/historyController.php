<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Repositories\HistoryRepository;
class historyController extends Controller
{
  protected $history;

 public function __construct(HistoryRepository $history)
 {
   //$this->middleware('auth');
   //var_dump($factions);
   $this->history = $history;
 }

 public function index(Request $request)
   {
     echo json_encode($this->history->All());
     //var_dump($this->factions->All());
       /*return view('faction.index', [
           'faction' => $this->factions->All() ,
       ]);*/
   }
}
