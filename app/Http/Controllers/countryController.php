<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CountryRepository;
use App\Http\Requests;
// Necesitamos la clase Response para crear la respuesta especial con la cabecera de localización en el método Store()
use Response;
use Cache;
class countryController extends Controller
{
  protected $country;
/**
 * Contructor se encarga de poner valor a la classe de repository y de hacer efecto los middleware
 * @param CountryRepository $countrys [description]
 */
  public function __construct(CountryRepository $countrys)
  {
    //$this->middleware('auth');
    //var_dump($countrys);
    $this->country = $countrys;
    $this->middleware('tokenauth',['only'=>['store','update','destroy']]);
  }
  /**
  * Devuelve todo el contenido de la base de paises transformado en json
  * @param  Request $request Contenido que nos pasa el usuario
  * @return json devuelve un json para pasarselo al cliente
  */
  public function index(Request $request)
  {

    $countrys = null;
    $countrys =  Cache::remember('countrys',20/60, function(){
      return $this->country->All();
    });
    // Si no existe ese fabricante devolvemos un error.
    if (count($countrys)==0)
    {
      // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
      // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
      return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el usuario a la base de datos.'])],404);
    }

    return response()->json(['status'=>'ok','data'=>$countrys],200);
    // echo json_encode();
    //var_dump($this->countrys->All());
    /*return view('country.index', [
    'country' => $this->countrys->All() ,



    echo json_encode($this->country->All());
    //var_dump($this->countrys->All());
    /*return view('country.index', [
    'country' => $this->countrys->All() ,
  ]);*/
}
/**
* Devuelve todo el contenido de la base de paises egun el identificador transformado en json
* @param  Request $request Contenido que nos pasa el usuario
* @param  int $country identificador a bucsar
* @return json devuelve un json para pasarselo al cliente
*/
public function show($country)
{
  //
  // return "Se muestra Fabricante con id: $id";
  // Buscamos un fabricante por el id.
  $countrys=null;
  $countrys =  $this->country->show($country);
  // Si no existe ese fabricante devolvemos un error.
  if ($countrys==null)
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
    // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
    return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el usuario a la base de datos.'])],404);
  }

  return response()->json(['status'=>'ok','data'=>$countrys],200);
  // echo json_encode();
  //var_dump($this->countrys->All());
  /*return view('country.index', [
  'country' => $this->countrys->All() ,
]);*/
}
/**
 * Metodo que se encarga de guardar todo el contenido a la bd
 * @param  Request $request Contenido que pasa el cliente
 * @return json           Devuelve el contenido introduzido en la bd en formato json
 */
public function store(Request $request){
  //`id``facname``facdescription``facshortdescription`
  // Primero comprobaremos si estamos recibiendo todos los campos.
  //`histitle``hisdescription``hisDateEvent``hisshortDescription`
  if (!$request->input('couname')  )
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
    // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
    return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos necesarios para el proceso de alta.'])],422);
  }
  //echo $request::json()->all();

  // Insertamos una fila en Fabricante con create pasándole todos los datos recibidos.
  // En $request->all() tendremos todos los campos del formulario recibidos.
  $newcountry=$this->country->create($request);

  // Más información sobre respuestas en http://jsonapi.org/format/
  // Devolvemos el código HTTP 201 Created – [Creada] Respuesta a un country que resulta en una creación. Debería ser combinado con un encabezado Location, apuntando a la ubicación del nuevo recurso.

  $response = Response::make(json_encode(['data'=>$newcountry]), 201)->header('Location', 'http://www.dominio.local/fabricantes/'.$newcountry->id)->header('Content-Type', 'application/json');
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

  $countrys=$this->country->show($id)[0];
  //if (!$request->input('user_id') || !$request->input('countryitle') || !$request->input('poscontent') || !$request->input('posdescription') || !$request->input('posphoto') || !$request->input('category_id') || !$request->input('posshortdesc'))


  if($countrys == null){
    return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un avión con ese código asociado al usuario.'])],404);
  }
  // Listado de campos recibidos teóricamente.
  //if (!$request->input('facname') || !$request->input('facdescription')|| !$request->input('facshortdescription') )

  $couname=$request->input('couname');

  // El método de la petición se sabe a través de $request->method();
  /*	Modelo		Longitud		Capacidad		Velocidad		Alcance */
  if ($request->method() === 'PATCH')
  {
    // Creamos una bandera para controlar si se ha modificado algún dato en el método PATCH.
    $bandera = false;

    // Actualización parcial de campos.
    if ($couname)
    {
      $countrys->couname = $couname;
      $bandera=true;
    }



    if ($bandera)
    {
      // Almacenamos en la base de datos el registro.
      $countrys->save();
      return response()->json(['status'=>'ok','data'=>$countrys], 200);
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
  $histitle=$request->input('histitle');
  $hisdescription=$request->input('hisdescription');
  $hisDateEvent=$request->input('hisDateEvent');
  $hisshortDescription=$request->input('hisshortDescription');

  */
  // Si el método no es PATCH entonces es PUT y tendremos que actualizar todos los datos.
  if (!$couname )
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
    return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan valores para completar el procesamiento.'])],422);
  }
  $countrys->couname = $couname;

  // Almacenamos en la base de datos el registro.
  $countrys->save();

  return response()->json(['status'=>'ok','data'=>$countrys], 200);

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
  $countrys=$this->country->show($id);

  // Si no existe ese fabricante devolvemos un error.
  if (count($countrys) ==0)
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
    // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
    return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un fabricante con ese código.'])],404);
  }

  // El fabricante existe entonces buscamos todos los aviones asociados a ese fabricante.
  //	$aviones = $fabricante->aviones; // Sin paréntesis obtenemos el array de todos los aviones.

  // Comprobamos si tiene aviones ese fabricante.


  // Procedemos por lo tanto a eliminar el fabricante.
  $countrys[0]->hiserased = true;
  $countrys[0]->save();
  // Se usa el código 204 No Content – [Sin Contenido] Respuesta a una petición exitosa que no devuelve un body (como una petición DELETE)
  // Este código 204 no devuelve body así que si queremos que se vea el mensaje tendríamos que usar un código de respuesta HTTP 200.
  return response()->json(['code'=>204,'message'=>'Se ha eliminado el usuario correctamente.'],204);
}
}
