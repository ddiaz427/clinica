<?php

namespace App\Models\pto;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class PtoRefTipoEntidad extends Model
{
	use SoftDeletes;

    protected $table = 'pto_ref_tipo_entidad';
	protected $primaryKey = 'pk_id_tipo_entidad';
	protected $fillable = ['descripcion','created_by'];
    protected $dates = ['deleted_at'];

	public static function validate($input) {
		$rules = array(
			'descripcion' => 'Required',
		);
	
        return Validator::make($input, $rules);
	}

}
