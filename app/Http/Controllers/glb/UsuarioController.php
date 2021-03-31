<?php
namespace App\Http\Controllers\glb;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Gate;
use Auth;
use App\User;
use App\Models\glb\Rol;
use Session;
use Image;

class UsuarioController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
		parent::__construct();
		$this->middleware('permiso', ['except' => ['editarPerfil']]);
		\View::share ( 'titulo_pagina', 'Usuarios' );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$usuarios = User::all();
    	return view('glb.usuarios.index', ['usuarios' => $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$roles = Rol::all();
        return view('glb.usuarios.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$data = $request->all();
		$data['password'] = bcrypt($data['password']);
		$usuario = User::create($data);
		Session::flash('flash_message', 'Usuario agregado correctamente!');
		return redirect()->route('editar-usuario', ['id' => $usuario->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = "")
    {
		if($id != ""){
			$user = User::find($id);
		}
		else{
			$user = Auth::user();
		}
		return view('glb.usuarios.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$usuario = User::find($id);
		$roles = Rol::all();
		return view('glb.usuarios.edit', ['usuario' => $usuario, 'roles' => $roles]);
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
		$data = $request->all();
		if(empty($data['password'])){
			unset($data['password']);
		}
		else{
			$data['password'] = bcrypt($data['password']);
		}
		$usuario = User::find($id);
		$usuario->update($data);
		Session::flash('flash_message', 'Usuario actualizado correctamente!');
		return redirect()->back();
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editarPerfil(Request $request)
    {
		if(!empty($request->hasFile('avatar'))){
			$file = $request->file('avatar');
			$nombre_archivo = time().'_'.$file->getClientOriginalName();
			$nombre = 'avatar-users/'.Auth::user()->id.'/'.$nombre_archivo;
			\Storage::disk('local')->put($nombre,  \File::get($file));
			$imagen = Image::make(public_path('uploads/'.$nombre));
			$imagen->resize(300, 300)->save(public_path('uploads/'.$nombre));
			$usuario = Auth::user();
			$data = array(
				'imagen' => $nombre_archivo
			);
			$usuario->update($data);
			Session::flash('flash_message', 'Se actualizó la imagen correctamente!');
		}
		elseif ($request->isMethod('post')) {
			$data = $request->all();
			if(!empty($data)){
				if(empty($data['password'])){
					unset($data['password']);
				}
				else{
					$data['password'] = bcrypt($data['password']);
				}

				$usuario = Auth::user();
				$usuario->update($data);
				Session::flash('flash_message', 'Sus datos se actualizaron correctamente!');
			}
		}
		$user = Auth::user();
		return view('glb.usuarios.editar_perfil', ['user' => $user]);
    }
}
