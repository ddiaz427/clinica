<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diagnostico extends Model
{
   use SoftDeletes;
   public $timestamps = false;
   protected $table = 'diagnostico';
   protected $fillable = ['iddiagnostico', 'codigodiagnostico', 'nombrediagnostico', 'idsexo','edadminima','edadmaxima','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];
   public $primaryKey  = 'iddiagnostico';
   protected $dates = ['deleted_at'];
}
