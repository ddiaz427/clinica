<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
class Sexo extends Model
{	use SoftDeletes;
	public $timestamps = false;
    protected $table = 'sexo';
    protected $fillable = ['idsexo', 'codigosexo', 'nombresexo','pordefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];
    public $primaryKey  = 'idsexo';
    protected $dates = ['deleted_at'];
}
