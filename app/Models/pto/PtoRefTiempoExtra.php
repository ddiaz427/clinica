<?php

namespace App\Models\pto;

use Illuminate\Database\Eloquent\Model;

class PtoRefTiempoExtra extends Model
{
    protected $table = 'pto_ref_tiempo_extra';
	protected $primaryKey = 'pk_id_tiempo_extra';
	protected $fillable = ['hora_inicio','hora_final','observacion','created_by'];
	
	public static function boot()
    {
        static::creating(function ($categoria) {
            $categoria->created_by = Auth::user()->id;
        });
    }
}
