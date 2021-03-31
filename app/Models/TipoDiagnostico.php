<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoDiagnostico extends Model
{
   use SoftDeletes;		
   public $timestamps = false;
   protected $table = 'tipodiagnostico';
   protected $fillable = ['idtipodiagnostico', 'nombretipodiagnostico', 'pordefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];
    public $primaryKey  = 'idtipodiagnostico';
    protected $dates = ['deleted_at'];
}
