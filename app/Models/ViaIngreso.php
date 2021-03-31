<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
class ViaIngreso extends Model
{
	use SoftDeletes;
   	public $timestamps = false;
    protected $table = 'viaingreso';
    protected $fillable = ['idviaingreso', 'nombreviaingreso','pordefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];

    public $primaryKey  = 'idviaingreso';
    protected $dates = ['deleted_at'];
}
