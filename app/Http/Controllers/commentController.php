<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\CommentRepository;

class commentController extends Controller
{


    protected $comments;

    function __construct(CommentRepository $comments){
        $this->comments = $comments;
    }
    public function index(Request $request)
    {
      echo json_encode($this->comments->All());
      //var_dump($this->factions->All());
      /*return view('faction.index', [
      'faction' => $this->factions->All() ,
    ]);*/
  }
}
