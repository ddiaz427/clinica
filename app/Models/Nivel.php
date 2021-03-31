<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
class Nivel extends Model
{
	use SoftDeletes;
   	public $timestamps = false;
    protected $table = 'nivel';
    protected $fillable = ['idnivel', 'nombrenivel','pordefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];

    public $primaryKey  = 'idnivel';
    protected $dates = ['deleted_at'];
}
