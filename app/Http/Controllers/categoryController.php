<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Repositories\CategoryRepository;

class categoryController extends Controller
{
  protected $categories;

  function __construct(CategoryRepository $categories){
      $this->categories = $categories;
  }
  public function index(Request $request)
  {
    echo json_encode($this->categories->All());
    //var_dump($this->factions->All());
    /*return view('faction.index', [
    'faction' => $this->factions->All() ,
  ]);*/
}
}
