<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
class ExamenFisicoPaciente extends Model
{
	//use SoftDeletes;
   	public $timestamps = false;
    protected $table = 'examenfisicopaciente';
    protected $fillable = ['idadmision', 'idinstitucionips','idadmisionprocedimiento','idexamenfisico','idestado','descripcion','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];

    public $primaryKey  = 'idadmision';
    //protected $dates = ['deleted_at'];
}
