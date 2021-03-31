<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
class Municipios extends Model
{
	use SoftDeletes;
   	public $timestamps = false;
    protected $table = 'municipio';
    protected $fillable = ['idmunicipio', 'iddepartamento', 'codigomunicipiodane','nombremunicipio','pordefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];

    public $primaryKey  = 'idmunicipio';
    protected $dates = ['deleted_at'];
}
