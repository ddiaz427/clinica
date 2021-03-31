<?php
namespace App\Models\glb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Validator;

class RolModulo extends Model
{
	protected $table = 'glb_det_rolmodulos';
    protected $fillable = ['rol_id', 'modulo_id', 'modificar', 'consultar', 'agregar', 'eliminar'];

}
