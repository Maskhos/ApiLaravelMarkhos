<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Cache;

use App\Repositories\PostRepository;

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
// Necesitamos la clase Response para crear la respuesta especial con la cabecera de localización en el método Store()
use Response;
class postController extends Controller
{
  protected $post;
  /**
   * COntructor se encarga de rellenar el repostory y poner los middlews
   * @param PostRepository $post [description]
   */
  public function __construct(PostRepository $post)
  {
    //$this->middleware('auth');
    //var_dump($factions);
    $this->post = $post;
    $this->middleware('tokenauth',['only'=>['store','update','destroy']]);
  }
/**
 * Mostrar todo el contenido de la bd en formato json
 * @return json Devuelve un jso n
 */
  public function index(){
    $posts = null;
    $posts = Cache::remember('posts',20/60, function(){
      return  $this->post->all();
    });

    // Si no existe ese fabricante devolvemos un error.
    if (count($posts)==0)
    {
      // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
      // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
      return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el usuario a la base de datos.'])],404);
    }



    return response()->json(['status'=>'ok','data'=>$posts],200);
  }
  /**
   * Metodo que se encarga de mostrar todos los post con sus comentarios
   * @param  int $id identificador
   * @return json      Devueve json
   */
  public function postWithComments($id){

    //
    // return "Se muestra Fabricante con id: $id";
    // Buscamos un fabricante por el id.
    $posts=null;
    $posts =  Cache::remember('postcomments',2, function() use ($id){
      $this->post->postWithComments($id);
    });
    //var_dump($posts);
    // Si no existe ese fabricante devolvemos un error.
    if (count($posts)==0)
    {
      // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
      // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
      return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el usuario a la base de datos.'])],404);
    }


    return response()->json(['status'=>'ok','data'=>$posts],200);
    // echo json_encode();
    //var_dump($this->factions->All());
    /*return view('faction.index', [
    'faction' => $this->factions->All() ,
  ]);*/
}
/**
 * Metodo que se encarga de mostrar todos los post por categorias
 * @param  int $id identificador de categoria
 * @return json     Devuelve un json con los post segun categoria
 */
public function bycategory($id){
  $posts =null;
  $posts =  $this->post->bycategory($id);// Si no existe ese fabricante devolvemos un error.

  if (count($posts)==0)
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
    // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
    return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el usuario a la base de datos.'])],404);
  }
  return response()->json(['status'=>'ok','data'=>$posts],200);
}
/**
 * Metodo que devuelve los ultimos post segun el limite que nos pase el cliente
 * @param  int $limit numero de limit de post a mostrar
 * @return json        Devuelve json con el limite en post
 */
public function lastspost($limit){
  $posts = null;
  $posts = $this->post->limitBy($limit);
  // Si no existe ese fabricante devolvemos un error.
  if (count($posts)==0)
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
    // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
    return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el usuario a la base de datos.'])],404);
  }

  return response()->json(['status'=>'ok','data'=>$posts],200);
}
// echo json_encode();
//var_dump($this->factions->All());
/*return view('faction.index', [
'faction' => $this->factions->All() ,
}
public function index(Request $request)
{

$posts = $this->post->All();
// Si no existe ese fabricante devolvemos un error.
if (count($posts)==0)
{
// Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
// En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el usuario a la base de datos.'])],404);
}

for ($i=0; $i < count($posts); $i++) {
$img = Image::make($posts[$i]->posphoto);
$posts[$i]->posphoto =  base64_encode($img->encode(''));
}

return response()->json(['status'=>'ok','data'=>$posts],200);
// echo json_encode();
//var_dump($this->factions->All());
/*return view('faction.index', [
'faction' => $this->factions->All() ,



echo json_encode($this->post->All());
//var_dump($this->factions->All());
/*return view('faction.index', [
'faction' => $this->factions->All() ,
]);*/
/**
 * Metodo que se encarga de mostrar un recurso de la bd por identificador
 * @param  int $post identificador
 * @return json       Devuelve el contenido en formato json
 */
public function show($post)
{
  //
  // return "Se muestra Fabricante con id: $id";
  // Buscamos un fabricante por el id.
  $posts=null;
  $posts =   $this->post->show($post);
  //var_dump($posts);
  // Si no existe ese fabricante devolvemos un error.
  if ($posts==null)
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
    // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
    return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el usuario a la base de datos.'])],404);
  }


  return response()->json(['status'=>'ok','data'=>$posts],200);
  // echo json_encode();
  //var_dump($this->factions->All());
  /*return view('faction.index', [
  'faction' => $this->factions->All() ,
]);*/
}
/**
 * Se encarga de  guardar el contenido en la bd
 * @param  Request $request Contenido que nos pasa el cliente
 * @return [type]           Devuelve un json con nuevo contenido
 */
public function store(Request $request){

  // Primero comprobaremos si estamos recibiendo todos los campos.
  //user,texto ,titulo , contenido del post ,  descripcion , photo  breve, categoria
  if (!$request->input('user_id') || !$request->input('postitle') || !$request->input('poscontent')  || !$request->file('posphoto') || !$request->input('category_id') || !$request->input('posshortdesc'))
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
    // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
    return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos necesarios para el proceso de alta.'])],422);
  }
  //echo $request::json()->all();

  // Insertamos una fila en Fabricante con create pasándole todos los datos recibidos.
  // En $request->all() tendremos todos los campos del formulario recibidos.
  $newpost=$this->post->create($request);
  if($newpost !=null){
    $img = Image::make($newpost->posphoto);
    $newpost->posphoto =  base64_encode($img->encode('jpeg'));
  }

  // Más información sobre respuestas en http://jsonapi.org/format/
  // Devolvemos el código HTTP 201 Created – [Creada] Respuesta a un POST que resulta en una creación. Debería ser combinado con un encabezado Location, apuntando a la ubicación del nuevo recurso.

  $response = Response::make(json_encode(['data'=>$newpost]), 201)->header('Location', 'http://www.dominio.local/fabricantes/'.$newpost->id)->header('Content-Type', 'application/json');
  return $response;
}
/**
* Update the specified resource in storage.
*
* @param  int  $id
* @return Response
*/
public function update(Request $request, $posid,$type)
{
  //
  // return "Se muestra Fabricante con id: $id";
  // Buscamos un fabricante por el id.
  $posts=$this->post->show($posid);
  //if (!$request->input('user_id') || !$request->input('postitle') || !$request->input('poscontent') || !$request->input('posdescription') || !$request->input('posphoto') || !$request->input('category_id') || !$request->input('posshortdesc'))


  if($posts == null){
    return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un avión con ese código asociado al usuario.'])],404);
  }
  // Listado de campos recibidos teóricamente.
  //email, redes sociales , contrasenya
  $user_id=$request->input('user_id');
  $postitle=$request->input('postitle');
  $poscontent=$request->input('poscontent');
  $posdescription=$request->input('posdescription');
  $posphoto=$request->file('posphoto');
  $category_id=$request->input('category_id');
  $posshortdesc=$request->input('posshortdesc');
  // El método de la petición se sabe a través de $request->method();
  /*	Modelo		Longitud		Capacidad		Velocidad		Alcance */
  if ($type === 'PATCH')
  {
    // Creamos una bandera para controlar si se ha modificado algún dato en el método PATCH.
    $bandera = false;

    // Actualización parcial de campos.
    if ($user_id)
    {
      $posts->user_id = $user_id;
      $bandera=true;
    }

    if ($postitle)
    {
      $posts->postitle = $postitle;
      $bandera=true;
    }

    if ($poscontent)
    {
      $posts->poscontent = $poscontent;
      $bandera=true;
    }

    if ($posdescription)
    {
      $posts->posdescription = $posdescription;
      $bandera=true;
    }

    if ($posphoto)
    {
      $img = Image::make($posphoto);
      $posts->posphoto =  base64_encode($img->encode('jpeg'));
      $bandera=true;
    }
    if ($category_id)
    {
      $posts->category_id = $category_id;
      $bandera=true;
    }
    if ($posshortdesc)
    {
      $posts->posshortdesc = $posshortdesc;
      $bandera=true;
    }

    if ($bandera)
    {
      // Almacenamos en la base de datos el registro.
      $posts->save();

      if($posts->posphoto !=null){
        $img = Image::make($posts->posphoto);
        $posts->posphoto =  base64_encode($img->encode('png'));
      }
      if($posts["users"]->uspicture !=null){
        $img2 = Image::make($posts["users"]->uspicture);

        $posts["users"]->uspicture = base64_encode($img2->encode('png'));
      }
      return response()->json(['status'=>'ok','data'=>$posts], 200);
    }
    else
    {
      // Se devuelve un array errors con los errores encontrados y cabecera HTTP 304 Not Modified – [No Modificada] Usado cuando el cacheo de encabezados HTTP está activo
      // Este código 304 no devuelve ningún body, así que si quisiéramos que se mostrara el mensaje usaríamos un código 200 en su lugar.
      return response()->json(['errors'=>array(['code'=>304,'message'=>'No se ha modificado ningún dato del avión.'])],304);
    }
  }
  /*
  * $user_id=$request->input('user_id');
  $postitle=$request->input('postitle');
  $poscontent=$request->input('poscontent');
  $posdescription=$request->input('posdescription');
  $posphoto=$request->input('posphoto');
  $category_id=$request->input('category_id');
  $posshortdesc=$request->input('posshortdesc');
  */
  // Si el método no es PATCH entonces es PUT y tendremos que actualizar todos los datos.
  if (!$user_id || !$postitle || !$poscontent || !$posdescription || !$posphoto || !$category_id || !$posshortdesc )
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
    return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan valores para completar el procesamiento.'])],422);
  }
  $posts->user_id = $user_id;
  $posts->postitle = $postitle;
  $posts->poscontent = $poscontent;
  $posts->posdescription = $posdescription;
  $posts->posphoto = $posphoto;
  $posts->category_id = $category_id;
  $posts->posshortdesc = $posshortdesc;

  // Almacenamos en la base de datos el registro.
  $posts->save();
  if($posts->posphoto !=null){
    $img = Image::make($posts->posphoto);
    $posts->posphoto =  base64_encode($img->encode('jpeg'));
  }
  if($posts["users"]->uspicture !=null){
    $img = Image::make($posts["users"]->uspicture);
    $posts["users"]->uspicture =  base64_encode($img->encode('png'));
  }
  return response()->json(['status'=>'ok','data'=>$posts], 200);

}

protected function pages($size){
  $posts =null;
  $posts =   $this->post->byPages($size);


  // Si no existe ese fabricante devolvemos un error.
  if (count($posts)==0)
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
    // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
    return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el usuario a la base de datos.'])],404);
  }



  return response()->json(['status'=>'ok','data'=>$posts],200);
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
  $posts=$this->post->show($id);

  // Si no existe ese fabricante devolvemos un error.
  if ($posts == null )
  {
    // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
    // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
    return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un fabricante con ese código.'])],404);
  }

  // El fabricante existe entonces buscamos todos los aviones asociados a ese fabricante.
  //	$aviones = $fabricante->aviones; // Sin paréntesis obtenemos el array de todos los aviones.

  // Comprobamos si tiene aviones ese fabricante.


  // Procedemos por lo tanto a eliminar el fabricante.
  $posts->poserased = true;
  $posts->save();
  // Se usa el código 204 No Content – [Sin Contenido] Respuesta a una petición exitosa que no devuelve un body (como una petición DELETE)
  // Este código 204 no devuelve body así que si queremos que se vea el mensaje tendríamos que usar un código de respuesta HTTP 200.
  return response()->json(['code'=>204,'message'=>'Se ha eliminado el usuario correctamente.'],204);


}
}
