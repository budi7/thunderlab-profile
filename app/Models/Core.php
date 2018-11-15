<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Core extends Model
{
    use SoftDeletes;

	protected $guarded 				= array();
	protected $table 				= 'cores';
    protected $primaryKey 			= 'id';
    protected $fillable = [
        'key', 'value',
    ];
    protected $rules = array(
        'key'     => 'bail|required|max:255',
        'value'   => 'bail|required|json',
    );
    protected $hidden = [
    ];
    protected $errors 				= [];


    // Error handling
    function getErrors(){
		return $this->errors;
    }	
    function setError($msg){
		$this->errors = $msg;
		return true;
	}
}
