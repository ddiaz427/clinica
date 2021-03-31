<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoServicio extends Model
{
   use SoftDeletes;		
   public $timestamps = false;
   protected $table = 'tiposervicio';
   protected $fillable = ['idtiposervicio', 'nombretiposervicio','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];
    public $primaryKey  = 'idtiposervicio';
    protected $dates = ['deleted_at'];
}
