<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Repositories\CharacterRepository;
// Necesitamos la clase Response para crear la respuesta especial con la cabecera de localización en el método Store()
use Response;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
class characterController extends Controller
{
  protected $character;

  function __construct(CharacterRepository $characters){
    $this->character = $characters;
  }
  public function index(Request $request)
  {

    $characters = $this->character->All();

    // Si no existe ese fabricante devolvemos un error.
    if (count($characters)==0)
    {
      // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
      // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
      return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el usuario a la base de datos.'])],404);
    }
    for ($i=0; $i < count($characters); $i++) {

      $img = Image::make($characters[$i]->charportrait);
      //  $characters[$i]->charportrait =  base64_encode($img->encode('jpeg'));

      $characters[$i]->charportrait =  base64_encode($img->encode('png'));
      if($characters[$i]->charfacechar !=null){
        $img = Image::make($characters[$i]->charfacechar);

        $characters[$i]->charfacechar = base64_encode($img->encode('png'));
      }

    }
    return response()->json(['status'=>'ok','data'=>$characters],200);
    // echo json_encode();
    //var_dump($this->characters->All());
    /*return view('character.index', [
    'character' => $this->characters->All() ,



    echo json_encode($this->character->All());
    //var_dump($this->characters->All());
    /*return view('character.index', [
    'character' => $this->characters->All() ,
  ]);*/
}
public function show($character)
{
  //
  // return "Se muestra Fabricante con id: $id";
  // Buscamos un fabricante por el id.
  $characters=$this->character->show($character);

  // Si no existe ese fabricante devolvemos un error.
  if (count($characters)==0)
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
    // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
    return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el usuario a la base de datos.'])],404);
  }
  for ($i=0; $i < count($characters); $i++) {

    $img = Image::make($characters[$i]->charportrait);
    //  $characters[$i]->charportrait =  base64_encode($img->encode('jpeg'));

    $characters[$i]->charportrait =  base64_encode($img->encode('png'));
    if($characters[$i]->charfacechar !=null){
      $img = Image::make($characters[$i]->charfacechar);
      $characters[$i]->charfacechar = base64_encode($img->encode('png'));
    }
    $img2 = Image::make($characters[$i]["factions"]->facphoto);
    $characters[$i]["factions"]->facphoto =base64_encode($img2->encode('png'));
  
  }
    return response()->json(['status'=>'ok','data'=>$characters],200);
    // echo json_encode();
    //var_dump($this->characters->All());
    /*return view('character.index', [
    'character' => $this->characters->All() ,
  ]);*/
}
public function store(Request $request){
  //`id``facname``facdescription``facshortdescription`
  // Primero comprobaremos si estamos recibiendo todos los campos.
  //`id``charclass``charname``charbio``charbirthdate``charportrait``charstylecombat``faction_id``charfacechar``charerased`
  if (!$request->input('charclass') || !$request->input('charname') || !$request->input('charbio') || !$request->input('charbirthdate')|| !$request->file('charportrait')|| !$request->file('charfacechar'))
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
    // En code podríamos indicar u  n código de error personalizado de nuestra aplicación si lo deseamos.
    return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos necesarios para el proceso de alta.'])],422);
  }
  //echo $request::json()->all();

  // Insertamos una fila en Fabricante con create pasándole todos los datos recibidos.
  // En $request->all() tendremos todos los campos del formulario recibidos.
  $newcharacter=$this->character->create($request);

  // Más información sobre respuestas en http://jsonapi.org/format/
  // Devolvemos el código HTTP 201 Created – [Creada] Respuesta a un character que resulta en una creación. Debería ser combinado con un encabezado Location, apuntando a la ubicación del nuevo recurso.

  $response = Response::make(json_encode(['data'=>$newcharacter]), 201)->header('Location', 'http://www.dominio.local/fabricantes/'.$newcharacter->id)->header('Content-Type', 'application/json');
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

  $characters=$this->character->show($id)[0];
  //if (!$request->input('user_id') || !$request->input('characteritle') || !$request->input('poscontent') || !$request->input('posdescription') || !$request->input('posphoto') || !$request->input('category_id') || !$request->input('posshortdesc'))


  if($characters == null){
    return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un avión con ese código asociado al usuario.'])],404);
  }
  // Listado de campos recibidos teóricamente.
  //if (!$request->input('facname') || !$request->input('facdescription')|| !$request->input('facshortdescription') )
  ////`id``charclass``charname``charbio``charbirthdate``charportrait``charstylecombat``faction_id``charfacechar``charerased`

  $charclass=$request->input('charclass');
  $charname=$request->input('charname');
  $charbio=$request->input('charbio');
  $charbirthdate=$request->input('charbirthdate');
  $charportrait=$request->file('charportrait');
  $charstylecombat=$request->input('charstylecombat');
  $faction_id=$request->input('faction_id');
  $charfacechar=$request->file('charfacechar');


  // El método de la petición se sabe a través de $request->method();
  /*	Modelo		Longitud		Capacidad		Velocidad		Alcance */
  if ($request->method() === 'PATCH')
  {
    // Creamos una bandera para controlar si se ha modificado algún dato en el método PATCH.
    $bandera = false;

    // Actualización parcial de campos.
    if ($charclass)
    {
      $characters->charclass = $charclass;
      $bandera=true;
    }
    // Actualización parcial de campos.
    if ($charname)
    {
      $characters->charname = $charname;
      $bandera=true;
    }
    // Actualización parcial de campos.
    if ($charbio)
    {
      $characters->charbio = $charbio;
      $bandera=true;
    }
    // Actualización parcial de campos.
    if ($charbirthdate)
    {
      $characters->charbirthdate = $charbirthdate;
      $bandera=true;
    }
    // Actualización parcial de campos.
    if ($charportrait)
    {
      $characters->charportrait = $charportrait;
      $bandera=true;
    }
    // Actualización parcial de campos.
    if ($charstylecombat)
    {
      $characters->charstylecombat = $charstylecombat;
      $bandera=true;
    }
    // Actualización parcial de campos.
    if ($faction_id)
    {
      $characters->faction_id = $faction_id;
      $bandera=true;
    }
    // Actualización parcial de campos.
    if ($charfacechar)
    {
      $characters->charfacechar = $charfacechar;
      $bandera=true;
    }



    if ($bandera)
    {
      // Almacenamos en la base de datos el registro.
      $characters->save();
      return response()->json(['status'=>'ok','data'=>$characters], 200);
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
  if (!$charclass || !$charname  || !$charbio|| !$charbirthdate|| !$charportrait|| !$charstylecombat|| !$faction_id|| !$charfacechar)
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
    return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan valores para completar el procesamiento.'])],422);
  }
  $characters->charclass = $charclass;
  $characters->charname = $charname;
  $characters->charbirthdate = $charbirthdate;
  $characters->charportrait = $charportrait;
  $characters->charstylecombat = $charstylecombat;
  $characters->faction_id = $faction_id;
  $characters->charfacechar = $charfacechar;
  // Almacenamos en la base de datos el registro.
  $characters->save();
  return response()->json(['status'=>'ok','data'=>$characters], 200);

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
  $characters=$this->character->show($id);

  // Si no existe ese fabricante devolvemos un error.
  if (count($characters) ==0)
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
    // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
    return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un fabricante con ese código.'])],404);
  }

  // El fabricante existe entonces buscamos todos los aviones asociados a ese fabricante.
  //	$aviones = $fabricante->aviones; // Sin paréntesis obtenemos el array de todos los aviones.

  // Comprobamos si tiene aviones ese fabricante.


  // Procedemos por lo tanto a eliminar el fabricante.
  $characters[0]->charerased = true;
  $characters[0]->save();
  // Se usa el código 204 No Content – [Sin Contenido] Respuesta a una petición exitosa que no devuelve un body (como una petición DELETE)
  // Este código 204 no devuelve body así que si queremos que se vea el mensaje tendríamos que usar un código de respuesta HTTP 200.
  return response()->json(['code'=>204,'message'=>'Se ha eliminado el usuario correctamente.'],204);


}
}
