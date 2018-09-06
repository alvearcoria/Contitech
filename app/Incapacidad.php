<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incapacidad extends Model
{
    protected $table = 'incapacidades';
    protected $primaryKey = 'id_incapacidad'; 

     public function scopeName($query, $name){
		if(trim($name!="")){
			$query->whereHas('paciente', function ($query) use ($name) {
                        $query->where('nombre_pac',"like","%".$name."%");
                });
			}

	}

	 public function scopeStatus($query, $status){
		if(trim($status == "A" or $status == "T" )){
			$query->where('estatus_inc','=',$status);
			}
	}

	 public function scopePlanta($query, $planta){
		if(trim($planta != null)){
			$query->where('id_planta','=',$planta);
			}
	}

    public function paciente(){
    	return $this->belongsTo(Paciente::class, 'id_paciente');
	}

	public function detIncapacidad(){
		return $this->hasMany(DetIncapacidad::class, 'id_incapacidad');
	}	

	public function accidente(){
        return $this->belongsTo(Accidente::class,'id_accidente');
    }

    public function planta(){
        return $this->belongsTo(Planta::class,'id_planta');
    }


}
