<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class TipoDocumentos extends Model
{	
   public $timestamps = false;
   use SoftDeletes;	
   protected $table = 'tipodocumento';
   protected $fillable = ['idtipodocumento', 'abreviatura', 'nombretipodocumento', 'pordefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];
   public $primaryKey  = 'idtipodocumento';
   protected $dates = ['deleted_at'];
}
