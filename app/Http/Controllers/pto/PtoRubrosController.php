<?php

namespace App\Http\Controllers\pto;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\pto\PtoRefRubro;

use Session;
use Input;
use Validator;




class PtoRubrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
         return view('pto/maestros/rubros.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cargarRubros(Request $request)
    {
          
        $respuesta=array();
   
       // GET ALL THE INPUT DATA , $_GET,$_POST,$_FILES.
        $input = Input::all();
        
        // VALIDATION RULES
        $rules = array(
            
            'archivo' => 'required|mimes:xls,xlsx,csv,txt|max:20000'
        );
    
       // PASS THE INPUT AND RULES INTO THE VALIDATOR
        $validation = Validator::make($input, $rules);
 
        // CHECK GIVEN DATA IS VALID OR NOT
        if ($validation->fails()) {
           
            return redirect()->back()->withErrors($validation)->withInput();
        }
        
        
           $file = array_get($input,'archivo');
         // SET UPLOAD PATH
            $destinationPath = 'adjuntos';
            // GET THE FILE EXTENSION
            $extension = $file->getClientOriginalExtension();
         // RENAME THE UPLOAD WITH RANDOM NUMBER
         //$fileName = rand(11111, 99999) . '.' . $extension;
            $fileName='prueba.'.$extension;
         // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
            
            $upload_success = $file->move($destinationPath, $fileName);
        
        // IF UPLOAD IS SUCCESSFUL SEND SUCCESS MESSAGE OTHERWISE SEND ERROR MESSAGE
        if ($upload_success) {
            //return Redirect::to('/')->with('message', 'Image uploaded successfully');
            
             $respuesta[] = array(
                "valor" =>FALSE,
                "mensaje" =>NULL,
            );  
            Session::flash('flash_message', 'Archivo Cargado Correctamente');
            return redirect()->route('crear-pto-rubros');
        }else{
            
            $respuesta[] = array(
                "valor" =>FALSE,
                "mensaje" => "Error al cargar archivo.",
            );  
        }

        return json_encode($respuesta);
      



    }

    public function validarRubros(Request $request){
        $dato = $request->get('iniciar');
        dd($dato)

    }


}
