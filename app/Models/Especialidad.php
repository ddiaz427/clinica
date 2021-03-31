<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
class Especialidad extends Model
{
	use SoftDeletes;
   	public $timestamps = false;
    protected $table = 'especialidad';
    protected $fillable = ['idespecialidad', 'nombreespecialidad','pordefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];

    public $primaryKey  = 'idespecialidad';
    protected $dates = ['deleted_at'];
}
