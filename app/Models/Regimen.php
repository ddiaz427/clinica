<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
class Regimen extends Model
{
	use SoftDeletes;
   	public $timestamps = false;
    protected $table = 'regimen';
    protected $fillable = ['idregimen','nombreregimen','pordefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];

    public $primaryKey  = 'idregimen';
    protected $dates = ['deleted_at'];
}
