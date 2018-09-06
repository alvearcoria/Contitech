<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetIncapacidad extends Model
{
    protected $table = 'det_incapacidad';
    protected $primaryKey = 'id_det_incapacidad'; 

      public function incapacidad(){
    	return $this->belongsTo(Incapacidad::class, 'id_incapacidad');
	}
}
