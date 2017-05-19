<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

/**
* 
*/
class Mst_Departemen extends Model
{
	protected $table = "master.mst_departemen";
	protected $primaryId = "DEPARTEMEN_ID";
	protected $fillable = [
		'DEPARTEMEN_CODE','DEPARTEMEN_NAME'
	];
}

?>