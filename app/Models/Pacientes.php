<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class Pacientes extends Model
{
    public $timestamps = false;
    use SoftDeletes;
    protected $table = 'paciente';
    protected $fillable = ['idpaciente', 'idtipodocumento', 'numerodocumento', 'nombrepaciente', 'primernombre', 'segundonombre', 'primerapellido', 'segundoapellido', 'fechanacimiento', 'idmunicipionacimiento', 'idsexo', 'idestadocivil', 'idgruposanguineo', 'idocupacion', 'idreligion', 'direccion', 'numerotelefonofijo', 'numerocelular', 'email', 'idbarrio', 'idmunicipio', 'idzonaresidencial', 'idinstitucioneapb', 'idregimen', 'idtipoafiliacion','idnivel','fechacreacion','creadopor'];
    public $primaryKey  = 'idpaciente';
    protected $dates = ['deleted_at'];
    
	public static function validate($input) {
		$rules = array(
		);
        return Validator::make($input, $rules);
	}
}
