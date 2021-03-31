<?php

namespace App\Models\pto;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class PtoRefTipoMov extends Model
{
	use SoftDeletes;

    protected $table = 'pto_ref_tipos_mov';
	protected $primaryKey = 'pk_id_tipo_mov';
	protected $fillable = ['descrip_mov','created_by'];
    protected $dates = ['deleted_at'];

	public static function validate($input) {
		$rules = array(
			'descrip_mov' => 'Required',
		);
	
        return Validator::make($input, $rules);
	}

}
