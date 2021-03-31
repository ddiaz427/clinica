<?php

namespace App\Models\pto;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class PtoMstMovto extends Model
{
	use SoftDeletes;

    protected $table = 'pto_mst_movto';
	protected $primaryKey = 'pk_id_movto';
	protected $fillable = [
		'fk_id_empresa',
		'vigencia',
		'fk_id_tipo_transaccion',
		'fecha_movto',
		'nro_documento',
		'observacion',
		'fk_id_dependencia',
		'fk_id_estado',
		'fk_id_tercero',
		'acto_adminstrativo',
		'fecha_acto_administra',
		'nro_solicitud',
		'nro_traslado',
		'fk_id_contrato',
		'fk_id_parametro_gen',
		'created_by'
		];
    protected $dates = ['deleted_at'];

	public static function validate($input) {
		$rules = array(
			'vigencia' => 'required|numeric',
			'observacion' => 'required',
			//'fecha_movto' => 'required|date',
			'nro_documento' => 'required|numeric',
			'fk_id_tipo_transaccion' => 'required|numeric',
			'fk_id_dependencia' => 'required|numeric',
			'fk_id_estado' => 'required|numeric',
		);
	
        return Validator::make($input, $rules);
	}

    /**
     * Obtenemos los el estado de cada Movimiento. Relacion 1 a N hacia PtoRefEstado.
     */
    public function estado()
    {
        return $this->belongsTo('App\Models\pto\PtoRefEstado', 'fk_id_estado');
    }

    /**
     * Obtenemos los el tipotransaccion de cada Tipo Transacion. Relacion 1 a N hacia PtoRefTipoTransacion.
     */
    public function tipotransaccion()
    {
        return $this->belongsTo('App\Models\pto\PtoRefTipoTransacion', 'fk_id_tipo_transaccion');
    }

    /**
     * Obtenemos los el dependencia de cada Movimiento. Relacion 1 a N hacia PtoRefDependencia.
     */
    public function dependencia()
    {
        return $this->belongsTo('App\Models\pto\PtoRefDependencia', 'fk_id_dependencia');
    }

    /**
     * Obtenemos los detalles de cada movimiento. Relacion 1 a N hacia PtoDetMovto.
     */
    public function detalles()
    {
        return $this->hasMany('App\Models\pto\PtoDetMovto', 'fk_id_movto');
    }
}
