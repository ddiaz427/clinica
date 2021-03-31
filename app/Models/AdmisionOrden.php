<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
class AdmisionOrden extends Model
{
	use SoftDeletes;
   	public $timestamps = false;
    protected $table = 'admisionorden';
    protected $fillable = ['idadmisionorden', 'idadmision','idinstitucionips','idtipoorden','fechaorden','fechaorden','observacion','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];
    public $primaryKey  = 'idadmisionorden';
    protected $dates = ['deleted_at'];
}
