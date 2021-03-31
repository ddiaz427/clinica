<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Cmgmyr\Messenger\Traits\Messagable;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'lastname', 'email', 'password', 'phone', 'mobile', 'fax', 'imagen', 'Rol_id', 'estado', 'created_by'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
	
    /**
     * Get the usuarios that owns the rol.
     */
    public function rol()
    {
        return $this->belongsTo('App\Models\glb\Rol');
    }
	
    /**
     * Get if user has access to actual page.
     */
    public function hasAccess( $controlador = "", $accion = "")
    {
		if($accion == "" && $controlador == ""){
			$currentAction = \Route::getCurrentRoute()->getAction();
			$controlador = substr(strrchr($currentAction['controller'], "\\"), 1);
			$controladores = explode('@',$controlador);
			$accion = $controladores[1];
			$controlador = strtolower(str_replace("Controller","",$controladores[0]));
		}
		$permisos = $this->rol->modulos->where('modulo', $controlador);
		if(!empty($permisos)){
			foreach($permisos as $mod){
				switch($accion){
					case 'create':
						if($mod->pivot->agregar == 1){
							return true;
						}
						break;
					case 'store':
						if($mod->pivot->agregar == 1){
							return true;
						}
						break;
					case 'edit':
						if($mod->pivot->modificar == 1){
							return true;
						}
						break;
					case 'update':
						if($mod->pivot->modificar == 1){
							return true;
						}
						break;
					case 'index':
					case 'show':
					case 'entregarEmail':
					case 'enviarEmail':
					case 'indexComplete':
					case 'data':
					case 'getRubros':
						if($mod->pivot->consultar == 1){
							return true;
						}
						break;
					case 'destroy':
						if($mod->pivot->eliminar == 1){
							return true;
						}
						break;
				}
			}
			return false;
		}
		else{
			return false;
		}
    }

	public function avatar()
	{
		if(file_exists( public_path().'/uploads/avatar-users/'.$this->id.'/'.$this->imagen )) {
			return asset('uploads/avatar-users/'.$this->id.'/'.$this->imagen);
		} else {
			return asset('assets/layouts/layout3/img/avatar.png');
		}     
	}
	
}
