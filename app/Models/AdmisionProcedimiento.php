<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
class AdmisionProcedimiento extends Model
{
	//use SoftDeletes;
   	public $timestamps = false;
    protected $table = 'admisionprocedimiento';
    //protected $fillable = ['idprocedimiento', 'cups','soat','escirugia','nombreprocedimiento','formagenerica','idtiposervicio','idsexo','edadminimaprocedimiento','edadmaximaprocedimiento','procedimientoactivo','espos','uvrminimo','uvrmaximo','idsalacirugia','valor','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];

    public $primaryKey  = 'idadmision';
    //protected $dates = ['deleted_at'];
}
