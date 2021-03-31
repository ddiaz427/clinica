<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
class Ocupacion extends Model
{	
	use SoftDeletes;
	public $timestamps = false;
    protected $table = 'ocupacion';
    protected $fillable = ['idocupacion', 'nombreocupacion','pordefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];
    public $primaryKey  = 'idocupacion';
    protected $dates = ['deleted_at'];
}
