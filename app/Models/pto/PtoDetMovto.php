<?php

namespace App\Models\pto;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class PtoDetMovto extends Model
{
	use SoftDeletes;

    protected $table = 'pto_det_movto';
	protected $primaryKey = 'pk_id_movto_td';
	protected $fillable = [
		'codigo_rubro',
		'valor',
		'fk_id_movto',
		'fk_id_mov_afectado',
		'fk_id_estado',
		'created_by'
		];
    protected $dates = ['deleted_at'];

	public static function validate($input) {
		$rules = array(
		);
	
        return Validator::make($input, $rules);
	}

    /**
     * Obtenemos el Movimiento de cada detalle. Relacion 1 a N hacia PtoMstMovto.
     */
    public function movimiento()
    {
        return $this->belongsTo('App\Models\pto\PtoMstMovto', 'fk_id_movto');
    }

    /**
     * Obtenemos el Movimiento de cada detalle. Relacion 1 a N hacia PtoMstMovto.
     */
    public function rubro()
    {
        return $this->belongsTo('App\Models\pto\PtoRefRubro', 'codigo_rubro');
    }
}
