<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


use App\Repositories\PruebaRepository;
// Necesitamos la clase Response para crear la respuesta especial con la cabecera de localización en el método Store()
use Response;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
class pruebaController extends Controller
{
  protected $prueba;

  public function __construct(PruebaRepository $prueba)
  {
    //$this->middleware('auth');
    //var_dump($factions);
    $this->prueba = $prueba;
  }


  public function index(Request $request)
  {

    $pruebas = $this->prueba->All();
    // Si no existe ese fabricante devolvemos un error.
    for ($i=0; $i <count($pruebas) ; $i++) {
      $pruebas[$i]->image =   'data: image/jpeg;base64,'.base64_encode($pruebas[$i]->image);
    }


    // Format the image SRC:  data:{mime};base64,{data};
    //echo "<img src='".$pruebas[0]->image."'>"; <- to show image



    //  echo $output_file;

    return response()->json(['status'=>'ok','data'=>$pruebas],200);

    // echo json_encode();
    //var_dump($this->factions->All());
    /*return view('faction.index', [
    'faction' => $this->factions->All() ,

  */}
  public function store(Request $request){
    //`id``facname``facdescription``facshortdescription`
    // Primero comprobaremos si estamos recibiendo todos los campos.
    //`histitle``hisdescription``hisDateEvent``hisshortDescription`
    //var_dump($request->image);
    if (!$request->input('name'))
    {
      // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
      // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
      return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos necesarios para el proceso de alta.'])],422);
    }
    //echo $request::json()->all();
    //$tmpname = $request->file('image');
    //var_dump($tmpname);

    //$img = Image::make($tmpname);
      //$request->file('image') =  $img->decode('jpeg');
  //  var_dump($img);

    // Insertamos una fila en Fabricante con create pasándole todos los datos recibidos.
    // En $request->all() tendremos todos los campos del formulario recibidos.
    $newprueba=$this->prueba->create($request);
    $newprueba->image = base64_encode($newprueba->image);

    // Más información sobre respuestas en http://jsonapi.org/format/
    // Devolvemos el código HTTP 201 Created – [Creada] Respuesta a un country que resulta en una creación. Debería ser combinado con un encabezado Location, apuntando a la ubicación del nuevo recurso.

    $response = Response::make(json_encode(['data'=>$newprueba]), 201)->header('Location', 'http://www.dominio.local/fabricantes/'.$newprueba->id)->header('Content-Type', 'application/json');
    return $response;
  }
}
