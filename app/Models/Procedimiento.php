<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
class Procedimiento extends Model
{
	use SoftDeletes;
   	public $timestamps = false;
    protected $table = 'procedimiento';
    protected $fillable = ['idprocedimiento', 'cups','soat','escirugia','nombreprocedimiento','formagenerica','idtiposervicio','idsexo','edadminimaprocedimiento','edadmaximaprocedimiento','procedimientoactivo','espos','uvrminimo','uvrmaximo','idsalacirugia','valor','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];

    public $primaryKey  = 'idprocedimiento';
    protected $dates = ['deleted_at'];
}
