<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
class AdmisionRemision extends Model
{
	//use SoftDeletes;
   	public $timestamps = false;
    protected $table = 'admisionremision';
    protected $fillable = ['idadmision', 'idinstitucionips','idadmisionremision','fecharemision','horaremision','idespecialidad','descripcionremision','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];

    public $primaryKey  = 'idadmision';
    //protected $dates = ['deleted_at'];
}
