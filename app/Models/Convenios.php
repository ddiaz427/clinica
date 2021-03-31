<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
class Convenios extends Model
{
	//use SoftDeletes;
   	public $timestamps = false;
    protected $table = 'convenio';
    protected $fillable = ['idconvenio', 'numeroconvenio','nombreconvenio','idinstitucioneapb','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];

    public $primaryKey  = 'idconvenio';
    //protected $dates = ['deleted_at'];
}
