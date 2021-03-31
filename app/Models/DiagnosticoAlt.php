<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiagnosticoAlt extends Model
{
   use SoftDeletes;		
   public $timestamps = false;
   protected $table = 'diagnosticoalt';
   protected $fillable = ['iddiagnosticoalt', 'nombrediagnosticoalt', 'pordefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];
    public $primaryKey  = 'iddiagnosticoalt';
    protected $dates = ['deleted_at'];
}
