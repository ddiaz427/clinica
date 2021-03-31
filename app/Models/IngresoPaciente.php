<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
class IngresoPaciente extends Model
{
	use SoftDeletes;
   	public $timestamps = false;
    protected $table = 'admision';
    //protected $fillable = ['idbarrio', 'nombrebarrio','pordefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];

    public $primaryKey  = 'idadmision';
    protected $dates = ['deleted_at'];
}
