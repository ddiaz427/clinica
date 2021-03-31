<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
class TipoAtencion extends Model
{
	use SoftDeletes;
   	public $timestamps = false;
    protected $table = 'tipoatencion';
    protected $fillable = ['idtipoatencion', 'nombretipoatencion','pordefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];

    public $primaryKey  = 'idtipoatencion';
    protected $dates = ['deleted_at'];
}
