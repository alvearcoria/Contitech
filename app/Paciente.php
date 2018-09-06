<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Paciente extends Model
{
	use Sortable;
    protected $table = 'pacientes';
    protected $primaryKey = 'id_paciente'; 

    public $sortable = ['id_paciente', 'nombre_pac'];

    public function scopeName($query, $name){
		if(trim($name!="")){
			$query->where("nombre_pac","like","%".$name."%");
		}
	}

	public function incapacidad(){
    	return $this->hasMany(Incapacidad::class, 'id_paciente');
	}
}


//http://localhost/incapacidades/3/edit