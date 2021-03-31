<?php

namespace App\Models\pto;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class PtoRefEstado extends Model
{
	use SoftDeletes;

    protected $table = 'pto_ref_estados';
	protected $primaryKey = 'pk_id_estado';
	protected $fillable = ['descripcion','created_by'];
    protected $dates = ['deleted_at'];

	public static function validate($input) {
		$rules = array(
			'descripcion' => 'Required',
		);
	
        return Validator::make($input, $rules);
	}
	
    /**
     * Obtenemos los movimientos de cada estado. Relacion N a 1 hacia PtoMstMovto.
     */
    public function movimientos()
    {
        return $this->hasMany('App\Models\pto\PtoMstMovto');
    }
}
