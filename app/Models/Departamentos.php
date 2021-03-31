<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class Departamentos extends Model
{
   use SoftDeletes;
   public $timestamps = false;
   protected $table = 'departamento';
   protected $fillable = ['iddepartamento', 'codigodepartamentodane', 'nombredepartamento', 'pordefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];
   public $primaryKey  = 'iddepartamento';
    protected $dates = ['deleted_at'];
}
