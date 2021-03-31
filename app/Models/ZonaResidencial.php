<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;
class ZonaResidencial extends Model
{
	use SoftDeletes;
   	public $timestamps = false;
    protected $table = 'zonaresidencial';
    protected $fillable = ['idzonaresidencial', 'codigozonaresidencial','nombrezonaresidencial','pordefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];
    public $primaryKey  = 'idzonaresidencial';
    protected $dates = ['deleted_at'];
}
