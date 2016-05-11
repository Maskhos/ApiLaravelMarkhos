<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


use App\Repositories\PostRepository;
class postController extends Controller
{
  protected $post;

 public function __construct(PostRepository $post)
 {
   //$this->middleware('auth');
   //var_dump($factions);
   $this->post = $post;
 }

 public function index(Request $request)
   {
     echo json_encode($this->post->All());
     //var_dump($this->factions->All());
       /*return view('faction.index', [
           'faction' => $this->factions->All() ,
       ]);*/
   }
}
