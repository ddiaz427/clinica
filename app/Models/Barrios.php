<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
class Barrios extends Model
{
	use SoftDeletes;
   	public $timestamps = false;
    protected $table = 'barrio';
    protected $fillable = ['idbarrio', 'nombrebarrio','pordefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];

    public $primaryKey  = 'idbarrio';
    protected $dates = ['deleted_at'];
}
