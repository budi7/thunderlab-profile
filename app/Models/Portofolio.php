<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portofolio extends Model
{
    use SoftDeletes;

	protected $guarded 				= array();
	protected $table 				= 'portofolios';
    protected $primaryKey 			= 'id';
    protected $fillable = [
        'title', 'year', 'cover', 'description', 'client',
    ];
    protected $rules = array(
        'title'         => 'bail|required|max:255',
        'year'          => 'bail|required|digits:4',
        'cover'         => 'bail|required',
        'description'   => 'bail|required',
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
