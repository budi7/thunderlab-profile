<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    use SoftDeletes;

	  protected $guarded 				  = array();
	  protected $table 				    = 'careers';
    protected $primaryKey 			= 'id';
    protected $fillable = [
      'title', 'type', 'location', 'description', 'responsibilities',  'requirements', 'isAvailable'
    ];
    protected $rules = array(
      'title'              => 'bail|required|max:255',
      'type'               => 'bail|required|max:255',
      'location'           => 'bail|required|max:255',
      'description'        => 'bail|required',
      'responsibilities'   => 'bail|required',
      'requirements'       => 'bail|required',
      'isAvailable'        => 'bail|required|boolean',
      
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
