<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
class Antecedente extends Model
{
	use SoftDeletes;
   	public $timestamps = false;
    protected $table = 'antecedente';
    protected $fillable = ['idantecedente', 'nombreantecedente','idtipoantecedente','esboleano','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];

    public $primaryKey  = 'idantecedente';
    protected $dates = ['deleted_at'];
}
