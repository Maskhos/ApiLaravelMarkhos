<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\MechanicRepository;

// Necesitamos la clase Response para crear la respuesta especial con la cabecera de localización en el método Store()
use Response;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
class mechanicController extends Controller
{

    protected $mechanic;

   public function __construct(MechanicRepository $mechanic)
   {
     //$this->middleware('auth');
     //var_dump($factions);
     $this->mechanic = $mechanic;
   }



      public function index(Request $request)
      {

        $mechanics = $this->mechanic->All();
        // Si no existe ese fabricante devolvemos un error.
        if (count($mechanics)==0)
        {
          // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
          // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
          return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el usuario a la base de datos.'])],404);
        }
        for ($i=0; $i < count($mechanics); $i++) {
          if($mechanics[$i]->mecpicture != null){
            $img = Image::make($mechanics[$i]->mecpicture);
            $mechanics[$i]->mecpicture =  base64_encode($img->encode('png'));
          }
        }
        return response()->json(['status'=>'ok','data'=>$mechanics],200);
        // echo json_encode();
        //var_dump($this->factions->All());
        /*return view('faction.index', [
        'faction' => $this->factions->All() ,



        echo json_encode($this->mechanic->All());
        //var_dump($this->factions->All());
        /*return view('faction.index', [
        'faction' => $this->factions->All() ,
      ]);*/
    }
    public function show($mechanic)
    {
      //
      // return "Se muestra Fabricante con id: $id";
      // Buscamos un fabricante por el id.
      $mechanics=$this->mechanic->show($mechanic);

      // Si no existe ese fabricante devolvemos un error.
      if (count($mechanics)==0)
      {
        // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
        // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
        return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el usuario a la base de datos.'])],404);
      }

      return response()->json(['status'=>'ok','data'=>$mechanics],200);
      // echo json_encode();
      //var_dump($this->factions->All());
      /*return view('faction.index', [
      'faction' => $this->factions->All() ,
    ]);*/
    }
    public function store(Request $request){
      // Primero comprobaremos si estamos recibiendo todos los campos.
      //`mectitle``mecpicture``mecvideo`
      if (!$request->input('mectitle') || !$request->input('mecpicture') || !$request->input('mecvideo') )
      {
        // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
        // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
        return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos necesarios para el proceso de alta.'])],422);
      }
      //echo $request::json()->all();

      // Insertamos una fila en Fabricante con create pasándole todos los datos recibidos.
      // En $request->all() tendremos todos los campos del formulario recibidos.
      $newmechanic=$this->mechanic->create($request);

      // Más información sobre respuestas en http://jsonapi.org/format/
      // Devolvemos el código HTTP 201 Created – [Creada] Respuesta a un mechanic que resulta en una creación. Debería ser combinado con un encabezado Location, apuntando a la ubicación del nuevo recurso.

      $response = Response::make(json_encode(['data'=>$newmechanic]), 201)->header('Location', 'http://www.dominio.local/fabricantes/'.$newmechanic->id)->header('Content-Type', 'application/json');
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
      ////`mectitle``mecpicture``mecvideo`
      $mechanics=$this->mechanic->show($id)[0];
      //if (!$request->input('user_id') || !$request->input('mechanicitle') || !$request->input('poscontent') || !$request->input('posdescription') || !$request->input('posphoto') || !$request->input('category_id') || !$request->input('posshortdesc'))


      if($mechanics == null){
        return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un avión con ese código asociado al usuario.'])],404);
      }
      // Listado de campos recibidos teóricamente.
      //email, redes sociales , contrasenya
      $mectitle=$request->input('mectitle');
      $mecpicture=$request->input('mecpicture');
      $mecvideo=$request->input('mecvideo');
      // El método de la petición se sabe a través de $request->method();
      /*	Modelo		Longitud		Capacidad		Velocidad		Alcance */
      if ($request->method() === 'PATCH')
      {
        // Creamos una bandera para controlar si se ha modificado algún dato en el método PATCH.
        $bandera = false;

        // Actualización parcial de campos.
        if ($mectitle)
        {
          $mechanics->mectitle = $mectitle;
          $bandera=true;
        }

        if ($mecpicture)
        {
          $mechanics->mecpicture = $mecpicture;
          $bandera=true;
        }

        if ($mecvideo)
        {
          $mechanics->mecvideo = $mecvideo;
          $bandera=true;
        }


        if ($bandera)
        {
          // Almacenamos en la base de datos el registro.
          $mechanics->save();
          return response()->json(['status'=>'ok','data'=>$mechanics], 200);
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
       $mechanicitle=$request->input('mechanicitle');
       $poscontent=$request->input('poscontent');
       $posdescription=$request->input('posdescription');
       $posphoto=$request->input('posphoto');
       $category_id=$request->input('category_id');
       $posshortdesc=$request->input('posshortdesc');
      */
      // Si el método no es PATCH entonces es PUT y tendremos que actualizar todos los datos.
      if (!$mectitle || !$mecpicture || !$mecvideo )
      {
        // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
        return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan valores para completar el procesamiento.'])],422);
      }
      $mechanics->mectitle = $mectitle;
      $mechanics->mecpicture = $mecpicture;
      $mechanics->mecvideo = $mecvideo;

      // Almacenamos en la base de datos el registro.
      $mechanics->save();

      return response()->json(['status'=>'ok','data'=>$mechanics], 200);

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
      $mechanics=$this->mechanic->show($id);

      // Si no existe ese fabricante devolvemos un error.
      if (count($mechanics) ==0)
      {
        // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
        // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
        return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un fabricante con ese código.'])],404);
      }

      // El fabricante existe entonces buscamos todos los aviones asociados a ese fabricante.
      //	$aviones = $fabricante->aviones; // Sin paréntesis obtenemos el array de todos los aviones.

      // Comprobamos si tiene aviones ese fabricante.


      // Procedemos por lo tanto a eliminar el fabricante.
      $mechanics[0]->mecerased = true;
      $mechanics[0]->save();
      // Se usa el código 204 No Content – [Sin Contenido] Respuesta a una petición exitosa que no devuelve un body (como una petición DELETE)
      // Este código 204 no devuelve body así que si queremos que se vea el mensaje tendríamos que usar un código de respuesta HTTP 200.
      return response()->json(['code'=>204,'message'=>'Se ha eliminado el usuario correctamente.'],204);


    }
}
