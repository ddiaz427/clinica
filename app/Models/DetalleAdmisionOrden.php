<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
class DetalleAdmisionOrden extends Model
{
	use SoftDeletes;
   	public $timestamps = false;
    protected $table = 'detalleadmisionorden';
    protected $fillable = ['iddetalleadmisionorden', 'idadmisionorden','idprocedimiento','cantidad','posologia','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];
    public $primaryKey  = 'iddetalleadmisionorden';
    protected $dates = ['deleted_at'];
}
