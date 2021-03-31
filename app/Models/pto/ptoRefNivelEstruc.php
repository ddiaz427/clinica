<?php

namespace App\Models\pto;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class ptoRefNivelEstruc extends Model
{
    use SoftDeletes;

    protected $table = 'pto_ref_niveles_estruct_cod';
	protected $primaryKey = 'pk_id_nivel';
	protected $fillable = ['vigencia','fk_id_tipo_mov','nivel','longitud','desde','descripcion','created_by'];
    protected $dates = ['deleted_at'];

	public static function validate($input) {
		$rules = array(
			'descripcion' => 'Required',
			'vigencia' => 'Required',
		);
	
        return Validator::make($input, $rules);
	}

	public function tiposmovto()
    {
        //return $this->belongsTo('App\Models\glb\Grupomodulo','grupomodulo_id');
        return $this->belongsTo('App\Models\pto\ptoRefTiposMov','fk_id_tipo_mov');
    } 
}
