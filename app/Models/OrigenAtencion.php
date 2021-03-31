<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
class OrigenAtencion extends Model
{
	use SoftDeletes;
   	public $timestamps = false;
    protected $table = 'origenatencion';
    protected $fillable = ['idorigenatencion', 'codigoorigenatencion','nombreorigenatencion','pordefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];

    public $primaryKey  = 'idorigenatencion';
    protected $dates = ['deleted_at'];
}
