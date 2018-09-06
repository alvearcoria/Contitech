<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accidente extends Model
{
    protected $table = 'accidente';
    protected $primaryKey = 'id_accidente'; 

    public function scopeName($query, $name){
		if(trim($name!="")){
			$query->whereHas('paciente', function ($query) use ($name) {
                        $query->where('nombre_pac',"like","%".$name."%");
                });
			}
	}

    public function paciente(){
    	return $this->belongsTo(Paciente::class, 'id_paciente');
	}

    public function diagnostico(){
        return $this->belongsTo(Diagnostico::class, 'id_diagn');
    }

    public function incapacidad(){
        return $this->hasMany(Incapacidad::class, 'id_accidente');
    }

    public function planta(){
        return $this->belongsTo(Planta::class, 'id_planta');
    }

}
