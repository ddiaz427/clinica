<?php

namespace App\Models\pto;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class PtoRefRubro extends Model
{
	use SoftDeletes;

    protected $table = 'pto_ref_rubros';
	protected $primaryKey = 'pk_id_rubro';
	protected $fillable = [
		'fk_id_empresa',
		'vigencia',
		'codigo_rubro',
		'descripcion',
		'acepta_valor',
		'destinacion_esp',
		'modificable',
		'fk_id_nivel',
		'bloqueado',
		'codigo_rubro_predecesor',
		'codigo_chip',
		'categoria',
		'control_adjuntos',
		'ordenador_propio',
		'reserva',
		'created_by'
		];
    protected $dates = ['deleted_at'];

	public static function validate($input) {
		$rules = array(
		);
	
        return Validator::make($input, $rules);
	}
	
    /**
     * Obtenemos los detalles de cada movimiento. Relacion 1 a N hacia PtoDetMovto.
     */
    public function detalles_mto()
    {
        return $this->hasMany('App\Models\pto\PtoDetMovto', 'codigo_rubro');
    }
}
