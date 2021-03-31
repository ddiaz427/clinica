<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
class Instituciones extends Model
{
	use SoftDeletes;
   	public $timestamps = false;
    protected $table = 'institucioneapb';
    protected $fillable = ['idinstitucioneapb', 'codigoinstitucioneapb','nombreinstitucioneapb','pordefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];

    public $primaryKey  = 'idinstitucioneapb';
    protected $dates = ['deleted_at'];
}
