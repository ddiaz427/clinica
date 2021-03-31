<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
class ExamenFisico extends Model
{
	//use SoftDeletes;
   	public $timestamps = false;
    protected $table = 'examenfisico';
    protected $fillable = ['idexamenfisico', 'nombreexamenfisico','orden','descripciondefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];

    public $primaryKey  = 'idexamenfisico';
    //protected $dates = ['deleted_at'];
}
