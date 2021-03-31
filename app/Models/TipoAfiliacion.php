<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class TipoAfiliacion extends Model
{
   use SoftDeletes;		
   public $timestamps = false;
   protected $table = 'tipoafiliacion';
   protected $fillable = ['idtipoafiliacion', 'nombretipoafiliacion', 'pordefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];
    public $primaryKey  = 'idtipoafiliacion';
    protected $dates = ['deleted_at'];
}
