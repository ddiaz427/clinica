<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
class TipoOrden extends Model
{
	use SoftDeletes;
   	public $timestamps = false;
    protected $table = 'tipoorden';
    protected $fillable = ['idtipoorden', 'nombretipoorden','pordefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];
    public $primaryKey  = 'idtipoorden';
    protected $dates = ['deleted_at'];
}
