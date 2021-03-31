<?php
namespace App\Models\glb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class Grupomodulo extends Model
{
	use SoftDeletes;
	protected $table = 'grupomodulos';
    protected $fillable = ['nombre', 'estado', 'created_by'];
    
    /**
     * Get the modulos for the Grupomodulo.
     */
    public function modulos()
    {
        return $this->hasMany('App\Models\glb\Modulo');
    }

    protected $dates = ['deleted_at'];

	public static function validate($input) {
		$rules = array(
		);
	
        return Validator::make($input, $rules);
	}


}
