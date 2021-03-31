<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
class GrupoSanguinio extends Model
{	
	public $timestamps = false;
	use SoftDeletes;
    protected $table = 'gruposanguineo';
    protected $fillable = ['idgruposanguineo', 'nombregruposanguineo','pordefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];
    public $primaryKey  = 'idgruposanguineo';
    protected $dates = ['deleted_at'];
}
