<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Etiologia extends Model
{
   use SoftDeletes;		
   public $timestamps = false;
   protected $table = 'etiologia';
   protected $fillable = ['idetiologia', 'nombreetiologia', 'pordefecto','fechacreacion','creadopor','fechaultmodificacion','modificadopor'];
   public $primaryKey  = 'idetiologia';
   protected $dates = ['deleted_at'];
}
