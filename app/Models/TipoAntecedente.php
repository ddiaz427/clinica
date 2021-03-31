<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoAntecedente extends Model
{
   use SoftDeletes;		
   public $timestamps = false;
   protected $table = 'tipoantecedente';
   protected $fillable = ['idtipoantecedente', 'nombretipoantecedente','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];
    public $primaryKey  = 'idtipoantecedente';
    protected $dates = ['deleted_at'];
}
