<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
// Necesitamos la clase Response para crear la respuesta especial con la cabecera de localización en el método Store()
use Response;

use App\Repositories\UserRepository;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
class UserController extends Controller
{
  protected $user;

  public function __construct(UserRepository $user)
  {
    //$this->middleware('auth');
    //var_dump($factions);
    $this->user = $user;
  }


  public function index(Request $request)
  {

    $users = $this->user->All();
    // Si no existe ese fabricante devolvemos un error.
    if (count($users)==0)
    {
      // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
      // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
      return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el usuario a la base de datos.'])],404);
    }
    for ($i=0; $i < count($users); $i++) {
      if($users[$i]->uspicture!=null){
        $img = Image::make($users[$i]->uspicture);
        $users[$i]->uspicture =  base64_encode($img->encode('jpeg'));
      }

    }
    return response()->json(['status'=>'ok','data'=>$users],200);
    // echo json_encode();
    //var_dump($this->factions->All());
    /*return view('faction.index', [
    'faction' => $this->factions->All() ,



    echo json_encode($this->user->All());
    //var_dump($this->factions->All());
    /*return view('faction.index', [
    'faction' => $this->factions->All() ,
  ]);*/
}
public function show($user)
{
  //
  // return "Se muestra Fabricante con id: $id";
  // Buscamos un fabricante por el id.
  $users=$this->user->show($user);

  // Si no existe ese fabricante devolvemos un error.
  if (count($users)==0)
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
    // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
    return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el usuario a la base de datos.'])],404);
  }
  for ($i=0; $i < count($users); $i++) {
    if($users[$i]->uspicture!=null){
      $img = Image::make($users[$i]->uspicture);
      $users[$i]->uspicture =  base64_encode($img->encode('jpeg'));
    }

  }

  return response()->json(['status'=>'ok','data'=>$users],200);
  // echo json_encode();
  //var_dump($this->factions->All());
  /*return view('faction.index', [
  'faction' => $this->factions->All() ,
]);*/
}

public function login(Request $request){

  if (!$request->input('email') || !$request->input('password'))
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
    // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
    return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos necesarios para el proceso de alta.'])],422);
  }
  //
  // return "Se muestra Fabricante con id: $id";
  // Buscamos un fabricante por el id.
  $users=$this->user->retrieveByCredentials($request->all());

  // Si no existe ese fabricante devolvemos un error.
  if ($users == null)
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
    // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
    return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el usuario a la base de datos.'])],404);
  }
  if($users->uspicture!=null){
    $img = Image::make($users->uspicture);
    $users->uspicture =  base64_encode($img->encode('jpeg'));
  }


  return response()->json(['status'=>'ok','data'=>$users],200);

}
public function store(Request $request){
  // Primero comprobaremos si estamos recibiendo todos los campos.
  //usname,userdesc,usbirthDate,faction_id,country_id,email,password
  //$request-file para coger imagenes <-QUIM RECUERDA
  if (!$request->input('usname') ||  !$request->input('usbirthDate') || !$request->input('faction_id') || !$request->input('country_id') || !$request->input('email') || !$request->input('password'))
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
    // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
    return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos necesarios para el proceso de alta.'])],422);
  }
  //echo $request::json()->all();

  // Insertamos una fila en Fabricante con create pasándole todos los datos recibidos.
  // En $request->all() tendremos todos los campos del formulario recibidos.
  $newUser=$this->user->create($request);

  // Más información sobre respuestas en http://jsonapi.org/format/
  // Devolvemos el código HTTP 201 Created – [Creada] Respuesta a un POST que resulta en una creación. Debería ser combinado con un encabezado Location, apuntando a la ubicación del nuevo recurso.

  $response = Response::make(json_encode(['data'=>$newUser]), 201)->header('Location', 'http://www.dominio.local/fabricantes/'.$newUser->id)->header('Content-Type', 'application/json');
  return $response;
}


public function bycredentials(Request $request){
  //
  // return "Se muestra Fabricante con id: $id";
  // Buscamos un fabricante por el id.
  $users=$this->user->retrieveByCredentials($request->all());

  // Si no existe ese fabricante devolvemos un error.
  if (count($users)==0)
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
    // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
    return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el usuario a la base de datos.'])],404);
  }

  return response()->json(['status'=>'ok','data'=>$users],200);
  // echo json_encode();
  //var_dump($this->factions->All());
  /*return view('faction.index', [
  'faction' => $this->factions->All() ,
]);*/

}

public function remember_token($id,$token){
  //
  // return "Se muestra Fabricante con id: $id";
  // Buscamos un fabricante por el id.
  $users=$this->user->updateRememberToken($id,$token);

  // Si no existe ese fabricante devolvemos un error.
  if (count($users)==0)
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
    // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
    return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el usuario a la base de datos.'])],404);
  }

  return response()->json(['status'=>'ok','data'=>$users],200);
  // echo json_encode();
  //var_dump($this->factions->All());
  /*return view('faction.index', [
  'faction' => $this->factions->All() ,
]);*/


}

public function bytoken($id,$token){
  //
  // return "Se muestra Fabricante con id: $id";
  // Buscamos un fabricante por el id.
  $users=$this->user->retrieveByToken($id,$token);

  // Si no existe ese fabricante devolvemos un error.
  if (count($users)==0)
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
    // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
    return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el usuario a la base de datos.'])],404);
  }

  return response()->json(['status'=>'ok','data'=>$users],200);
  // echo json_encode();
  //var_dump($this->factions->All());
  /*return view('faction.index', [
  'faction' => $this->factions->All() ,
]);*/


}
/**
* Update the specified resource in storage.
*
* @param  int  $id
* @return Response
*/
public function update(Request $request, $id, $type)
{
  //
  // return "Se muestra Fabricante con id: $id";
  // Buscamos un fabricante por el id.
  $users=$this->user->show($id)[0];

  if($users == null){
    return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un avión con ese código asociado al usuario.'])],404);
  }
  // Listado de campos recibidos teóricamente.
  //email, redes sociales , contrasenya



  $uspicture= $request->file('uspicture');
  $usname = $request->input("usname");
  $usbirthDate=$request->input('usbirthdate');
  $country_id=$request->input('country_id');
  $ustumblr=$request->input('ustumblr');
  $ustwitter=$request->input('ustwitter');
  $usdesc=$request->input('usdesc');
  $usfacebook=$request->input('usfacebook');
  $email = $request->input('email');
  $usintagram = $request->input('usinstagram');
  // El método de la petición se sabe a través de $request->method();
  /*	Modelo		Longitud		Capacidad		Velocidad		Alcance */
  if ($type === 'PATCH')
  {
    // Creamos una bandera para controlar si se ha modificado algún dato en el método PATCH.
    $bandera = false;

    // Actualización parcial de campos.
    if ($uspicture)
    {
      $users->uspicture = Image::make($uspicture)->encode('png');
      $bandera=true;
    }

    if ($usname)
    {
      $users->usname = $usname;
      $bandera=true;
    }
    if ($usbirthDate)
    {
      $users->usbirthDate = $usbirthDate;
      $bandera=true;
    }

    if ($country_id)
    {
      $users->country_id = $country_id;
      $bandera=true;
    }

    if ($ustumblr)
    {
      $users->$ustumblr = $ustumblr;
      $bandera=true;
    }

    if ($ustwitter)
    {
      $users->ustwitter = $ustwitter;
      $bandera=true;
    }
    if ($usdesc)
    {
      $users->usdesc = $usdesc;
      $bandera=true;
    }
    if ($usfacebook)
    {
      $users->usfacebook = $usfacebook;
      $bandera=true;
    }
    if ($usintagram)
    {
      $users->usintagramtter = $usintagram;
      $bandera=true;
    }
    if ($email)
    {
      $users->email = $email;
      $bandera=true;
    }
    if ($usintagram)
    {
      $users->usintagram = $usintagram;
      $bandera=true;
    }
    if ($bandera)
    {
      // Almacenamos en la base de datos el registro.
      $users->save();
      $users->uspicture= base64_encode($users->uspicture);
      return response()->json(['status'=>'ok','data'=>$users], 200);
    }
    else
    {
      // Se devuelve un array errors con los errores encontrados y cabecera HTTP 304 Not Modified – [No Modificada] Usado cuando el cacheo de encabezados HTTP está activo
      // Este código 304 no devuelve ningún body, así que si quisiéramos que se mostrara el mensaje usaríamos un código 200 en su lugar.
      return response()->json(['errors'=>array(['code'=>304,'message'=>'No se ha modificado ningún dato del avión.'])],304);
    }
  }
  /*
  $picture=$request->input('uspicture');
  $usbirthDate=$request->input('usbirthdate');
  $country_id=$request->input('country_id');
  $ustumblr=$request->input('ustumblr');
  $ustwitter=$request->input('ustwitter');
  $usdesc=$request->input('usdesc');
  $usfacebook=$request->input('usfacebook');
  $email = $request->input('email');
  $usintagram = $request->input('usinstagram');
  $password = $request->input('password');
  */
  // Si el método no es PATCH entonces es PUT y tendremos que actualizar todos los datos.
  if (!$uspicture || !$usbirthDate || !$country_id || !$ustumblr || !$ustwitter || !$usdesc || !$usfacebook || !$email  || !$usinstagram )
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
    return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan valores para completar el procesamiento.'])],422);
  }
  $users->uspicture = $uspicture;
  $users->usbirthDate = $usbirthDate;
  $users->country_id = $country_id;
  $users->ustumblr = $ustumblr;
  $users->ustwitter = $ustwitter;
  $users->usdesc = $usdesc;
  $users->usfacebook = $usfacebook;
  $users->email = $email;
  $users->usinstagram = $usinstagram;

  // Almacenamos en la base de datos el registro.
  $users->save();
  $users->uspicture = base64_encode($uspicture);

  return response()->json(['status'=>'ok','data'=>$users], 200);

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
  $users=$this->user->show($id)[0];

  // Si no existe ese fabricante devolvemos un error.
  if (!$user)
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
    // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
    return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un fabricante con ese código.'])],404);
  }

  // El fabricante existe entonces buscamos todos los aviones asociados a ese fabricante.
  //	$aviones = $fabricante->aviones; // Sin paréntesis obtenemos el array de todos los aviones.

  // Comprobamos si tiene aviones ese fabricante.


  // Procedemos por lo tanto a eliminar el fabricante.
  $users->userased = true;
  $users->save();
  // Se usa el código 204 No Content – [Sin Contenido] Respuesta a una petición exitosa que no devuelve un body (como una petición DELETE)
  // Este código 204 no devuelve body así que si queremos que se vea el mensaje tendríamos que usar un código de respuesta HTTP 200.
  return response()->json(['code'=>204,'message'=>'Se ha eliminado el usuario correctamente.'],204);


}
}
