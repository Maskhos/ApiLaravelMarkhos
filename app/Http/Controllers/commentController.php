<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\CommentRepository;
// Necesitamos la clase Response para crear la respuesta especial con la cabecera de localización en el método Store()
use Response;
class commentController extends Controller
{
    protected $comment;

    function __construct(CommentRepository $comments){
        $this->comment = $comments;
    }

     public function index(Request $request)
     {

       $comments = $this->comment->All();
       // Si no existe ese fabricante devolvemos un error.
       if (count($comments)==0)
       {
         // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
         // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
         return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el usuario a la base de datos.'])],404);
       }

       return response()->json(['status'=>'ok','data'=>$comments],200);
       // echo json_encode();
       //var_dump($this->comments->All());
       /*return view('comment.index', [
       'comment' => $this->comments->All() ,



       echo json_encode($this->comment->All());
       //var_dump($this->comments->All());
       /*return view('comment.index', [
       'comment' => $this->comments->All() ,
     ]);*/
    }
    public function show($comment)
    {
     //
     // return "Se muestra Fabricante con id: $id";
     // Buscamos un fabricante por el id.
     $comments=$this->comment->show($comment);

     // Si no existe ese fabricante devolvemos un error.
     if (count($comments)==0)
     {
       // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
       // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
       return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el usuario a la base de datos.'])],404);
     }

     return response()->json(['status'=>'ok','data'=>$comments],200);
     // echo json_encode();
     //var_dump($this->comments->All());
     /*return view('comment.index', [
     'comment' => $this->comments->All() ,
    ]);*/
    }
    public function store(Request $request){
     //`id``facname``facdescription``facshortdescription`
     // Primero comprobaremos si estamos recibiendo todos los campos.
    //comcomment":"comment1","user_id":1,"post_id
     if (!$request->input('comcomment') || !$request->input('user_id') || !$request->input('post_id')  )
     {
       // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
       // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
       return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos necesarios para el proceso de alta.'])],422);
     }
     //echo $request::json()->all();

     // Insertamos una fila en Fabricante con create pasándole todos los datos recibidos.
     // En $request->all() tendremos todos los campos del formulario recibidos.
     $newcomment=$this->comment->create($request);

     // Más información sobre respuestas en http://jsonapi.org/format/
     // Devolvemos el código HTTP 201 Created – [Creada] Respuesta a un comment que resulta en una creación. Debería ser combinado con un encabezado Location, apuntando a la ubicación del nuevo recurso.

     $response = Response::make(json_encode(['data'=>$newcomment]), 201)->header('Location', 'http://www.dominio.local/fabricantes/'.$newcomment->id)->header('Content-Type', 'application/json');
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

     $comments=$this->comment->show($id)[0];
     //if (!$request->input('user_id') || !$request->input('commentitle') || !$request->input('poscontent') || !$request->input('posdescription') || !$request->input('posphoto') || !$request->input('category_id') || !$request->input('posshortdesc'))


     if($comments == null){
       return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un avión con ese código asociado al usuario.'])],404);
     }
     // Listado de campos recibidos teóricamente.
     //if (!$request->input('facname') || !$request->input('facdescription')|| !$request->input('facshortdescription') )
     //  //comcomment":"comment1","user_id":1,"post_id
     $comcomment=$request->input('comcomment');
     $user_id=$request->input('user_id');
     $post_id=$request->input('post_id');

     // El método de la petición se sabe a través de $request->method();
     /*	Modelo		Longitud		Capacidad		Velocidad		Alcance */
     if ($request->method() === 'PATCH')
     {
       // Creamos una bandera para controlar si se ha modificado algún dato en el método PATCH.
       $bandera = false;

       // Actualización parcial de campos.
       if ($comcomment)
       {
         $comments->comcomment = $comcomment;
         $bandera=true;
       }
       // Actualización parcial de campos.
       if ($user_id)
       {
         $comments->user_id = $user_id;
         $bandera=true;
       }
       // Actualización parcial de campos.
       if ($post_id)
       {
         $comments->post_id = $post_id;
         $bandera=true;
       }



       if ($bandera)
       {
         // Almacenamos en la base de datos el registro.
         $comments->save();
         return response()->json(['status'=>'ok','data'=>$comments], 200);
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
     $comcomment=$request->input('comcomment');
     $user_id=$request->input('user_id');
     $post_id=$request->input('post_id');
     */
     // Si el método no es PATCH entonces es PUT y tendremos que actualizar todos los datos.
     if (!$comcomment || !$user_id  || !$post_id)
     {
       // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
       return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan valores para completar el procesamiento.'])],422);
     }
     $comments->comcomment = $comcomment;
     $comments->user_id = $user_id;
     $comments->post_id = $post_id;
     // Almacenamos en la base de datos el registro.
     $comments->save();
     return response()->json(['status'=>'ok','data'=>$comments], 200);

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
     $comments=$this->comment->show($id);

     // Si no existe ese fabricante devolvemos un error.
     if (count($comments) ==0)
     {
       // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
       // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
       return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un fabricante con ese código.'])],404);
     }

     // El fabricante existe entonces buscamos todos los aviones asociados a ese fabricante.
     //	$aviones = $fabricante->aviones; // Sin paréntesis obtenemos el array de todos los aviones.

     // Comprobamos si tiene aviones ese fabricante.


     // Procedemos por lo tanto a eliminar el fabricante.
     $comments[0]->comerased = true;
     $comments[0]->save();
     // Se usa el código 204 No Content – [Sin Contenido] Respuesta a una petición exitosa que no devuelve un body (como una petición DELETE)
     // Este código 204 no devuelve body así que si queremos que se vea el mensaje tendríamos que usar un código de respuesta HTTP 200.
     return response()->json(['code'=>204,'message'=>'Se ha eliminado el usuario correctamente.'],204);


    }
}
