<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
class EstadoCivil extends Model
{	
	public $timestamps = false;
	use SoftDeletes;
    protected $table = 'estadocivil';
    protected $fillable = ['idestadocivil', 'nombreestadocivil','pordefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];
    public $primaryKey  = 'idestadocivil';
    protected $dates = ['deleted_at'];
}
