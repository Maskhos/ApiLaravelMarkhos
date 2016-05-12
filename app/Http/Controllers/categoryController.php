<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Repositories\CategoryRepository;
// Necesitamos la clase Response para crear la respuesta especial con la cabecera de localización en el método Store()
use Response;
class categoryController extends Controller
{
  protected $category;

  function __construct(CategoryRepository $categories){
      $this->category = $categories;
  }
  public function index(Request $request)
  {

    $categorys = $this->category->All();
    // Si no existe ese fabricante devolvemos un error.
    if (count($categorys)==0)
    {
      // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
      // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
      return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el usuario a la base de datos.'])],404);
    }

    return response()->json(['status'=>'ok','data'=>$categorys],200);
    // echo json_encode();
    //var_dump($this->categorys->All());
    /*return view('category.index', [
    'category' => $this->categorys->All() ,



    echo json_encode($this->category->All());
    //var_dump($this->categorys->All());
    /*return view('category.index', [
    'category' => $this->categorys->All() ,
  ]);*/
 }
 public function show($category)
 {
  //
  // return "Se muestra Fabricante con id: $id";
  // Buscamos un fabricante por el id.
  $categorys=$this->category->show($category);

  // Si no existe ese fabricante devolvemos un error.
  if (count($categorys)==0)
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
    // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
    return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el usuario a la base de datos.'])],404);
  }

  return response()->json(['status'=>'ok','data'=>$categorys],200);
  // echo json_encode();
  //var_dump($this->categorys->All());
  /*return view('category.index', [
  'category' => $this->categorys->All() ,
 ]);*/
 }
 public function store(Request $request){
  //`id``facname``facdescription``facshortdescription`
  // Primero comprobaremos si estamos recibiendo todos los campos.
 //`id``charclass``charname``charbio``charbirthdate``charportrait``charstylecombat``faction_id``charfacechar``charerased`
  if (!$request->input('catname'))
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
    // En code podríamos indicar u  n código de error personalizado de nuestra aplicación si lo deseamos.
    return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos necesarios para el proceso de alta.'])],422);
  }
  //echo $request::json()->all();

  // Insertamos una fila en Fabricante con create pasándole todos los datos recibidos.
  // En $request->all() tendremos todos los campos del formulario recibidos.
  $newcategory=$this->category->create($request);

  // Más información sobre respuestas en http://jsonapi.org/format/
  // Devolvemos el código HTTP 201 Created – [Creada] Respuesta a un category que resulta en una creación. Debería ser combinado con un encabezado Location, apuntando a la ubicación del nuevo recurso.

  $response = Response::make(json_encode(['data'=>$newcategory]), 201)->header('Location', 'http://www.dominio.local/fabricantes/'.$newcategory->id)->header('Content-Type', 'application/json');
  return $response;
 }
 /**
 * Update the specified resource in storage.
 *
 * @param  int  $id
 * @return Response
 */
 public function update(Request $request, $id)
 {
  //
  // return "Se muestra Fabricante con id: $id";
  // Buscamos un fabricante por el id.
  ////`if (!$request->input('facname') || !$request->input('facdescription')|| !$request->input('facshortdescription') )

  $categorys=$this->category->show($id)[0];
  //if (!$request->input('user_id') || !$request->input('categoryitle') || !$request->input('poscontent') || !$request->input('posdescription') || !$request->input('posphoto') || !$request->input('category_id') || !$request->input('posshortdesc'))


  if($categorys == null){
    return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un avión con ese código asociado al usuario.'])],404);
  }
  // Listado de campos recibidos teóricamente.
  //if (!$request->input('facname') || !$request->input('facdescription')|| !$request->input('facshortdescription') )
  ////`id``charclass``charname``charbio``charbirthdate``charportrait``charstylecombat``faction_id``charfacechar``charerased`

  $catname=$request->input('catname');



  // El método de la petición se sabe a través de $request->method();
  /*	Modelo		Longitud		Capacidad		Velocidad		Alcance */
  if ($request->method() === 'PATCH')
  {
    // Creamos una bandera para controlar si se ha modificado algún dato en el método PATCH.
    $bandera = false;

    // Actualización parcial de campos.
    if ($catname)
    {
      $categorys->catname = $catname;
      $bandera=true;
    }




    if ($bandera)
    {
      // Almacenamos en la base de datos el registro.
      $categorys->save();
      return response()->json(['status'=>'ok','data'=>$categorys], 200);
    }
    else
    {
      // Se devuelve un array errors con los errores encontrados y cabecera HTTP 304 Not Modified – [No Modificada] Usado cuando el cacheo de encabezados HTTP está activo
      // Este código 304 no devuelve ningún body, así que si quisiéramos que se mostrara el mensaje usaríamos un código 200 en su lugar.
      return response()->json(['errors'=>array(['code'=>304,'message'=>'No se ha modificado ningún dato del avión.'])],304);
    }
  }
  /*
  *
  $charclass=$request->input('charclass');
  $charname=$request->input('charname');
  $charbio=$request->input('charbio');
  $charbirthdate=$request->input('charbirthdate');
  $charportrait=$request->input('charportrait');
  $charstylecombat=$request->input('charstylecombat');
  $faction_id=$request->input('faction_id');
  $charfacechar=$request->input('charfacechar');
  */
  // Si el método no es PATCH entonces es PUT y tendremos que actualizar todos los datos.
  if ( !$catname )
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
    return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan valores para completar el procesamiento.'])],422);
  }
  $categorys->catname = $catname;
  // Almacenamos en la base de datos el registro.
  $categorys->save();
  return response()->json(['status'=>'ok','data'=>$categorys], 200);

 }

 /**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return Response
 */
 public function destroy($id)
 {
  // Primero eliminaremos todos los aviones de un fabricante y luego el fabricante en si mismo.
  // Comprobamos si el fabricante que nos están pasando existe o no.
  $categorys=$this->category->show($id);

  // Si no existe ese fabricante devolvemos un error.
  if (count($categorys) ==0)
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
    // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
    return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un fabricante con ese código.'])],404);
  }

  // El fabricante existe entonces buscamos todos los aviones asociados a ese fabricante.
  //	$aviones = $fabricante->aviones; // Sin paréntesis obtenemos el array de todos los aviones.

  // Comprobamos si tiene aviones ese fabricante.


  // Procedemos por lo tanto a eliminar el fabricante.
  $categorys[0]->caterased = true;
  $categorys[0]->save();
  // Se usa el código 204 No Content – [Sin Contenido] Respuesta a una petición exitosa que no devuelve un body (como una petición DELETE)
  // Este código 204 no devuelve body así que si queremos que se vea el mensaje tendríamos que usar un código de respuesta HTTP 200.
  return response()->json(['code'=>204,'message'=>'Se ha eliminado el usuario correctamente.'],204);


 }
}
