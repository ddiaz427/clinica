<?php
namespace App\Models\glb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class Modulo extends Model
{
	use SoftDeletes;
	protected $table = 'modulos';
    protected $fillable = ['desc_modulo', 'modulo', 'grupomodulo_id', 'ruta_index', 'estado', 'created_by'];

    protected $dates = ['deleted_at'];

	public static function validate($input) {
		$rules = array(
		);
	
        return Validator::make($input, $rules);
	}

	/**
     * Get the roles for the modulo.
     */
	public function roles()
	{
		return $this->belongsToMany('App\Models\glb\Rol', 'rol_modulos', 'modulo_id', 'rol_id')->withPivot('modificar','consultar','agregar','eliminar');
	}
	
    /**
     * Get the grupomodulos that owns the Modulo.
     */
    public function grupomodulos()
    {
        return $this->belongsTo('App\Models\glb\Grupomodulo','grupomodulo_id');
    }

}
