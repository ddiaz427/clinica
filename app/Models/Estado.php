<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
class Estado extends Model
{
	//use SoftDeletes;
   	public $timestamps = false;
    protected $table = 'estado';
    protected $fillable = ['idestado', 'nombreestado','pordefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];

    public $primaryKey  = 'idestado';
    //protected $dates = ['deleted_at'];
}
