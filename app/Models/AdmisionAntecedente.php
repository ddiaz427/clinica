<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class AdmisionAntecedente extends Model
{
	//use SoftDeletes;
   	public $timestamps = false;
    protected $table = 'admisionantecedente';
    protected $fillable = ['idadmision', 'idinstitucionips','idantecedente','estado','descripcion','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];
    public $primaryKey  = 'idadmision';
    //protected $dates = ['deleted_at'];
}
