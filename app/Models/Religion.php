<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
class Religion extends Model
{	
	use SoftDeletes;
	public $timestamps = false;
    protected $table = 'religion';
    protected $fillable = ['idreligion', 'nombrereligion','pordefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];
    public $primaryKey  = 'idreligion';
    protected $dates = ['deleted_at'];
}
