<?php
namespace App\Models\glb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class Rol extends Model
{
	use SoftDeletes;
    protected $table = 'roles';
    protected $fillable = ['nombre', 'estado', 'created_by'];
    protected $dates = ['deleted_at'];

	public static function validate($input) {
		$rules = array(
		);
	
        return Validator::make($input, $rules);
	}


    /**
     * Get the usuarios for the rol.
     */
    public function usuarios()
    {
        return $this->hasMany('App\User');
    }

    /**
     * Get the modulos for the rol.
     */
	public function modulos()
	{
		return $this->belongsToMany('App\Models\glb\Modulo', 'rol_modulos', 'rol_id', 'modulo_id')->withPivot('modificar','consultar','agregar','eliminar')->orderBy('grupomodulo_id','asc')->orderBy('desc_modulo','asc');
	}
}
