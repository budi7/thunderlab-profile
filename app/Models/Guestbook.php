<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guestbook extends Model
{
    use SoftDeletes;

	protected $guarded 				= array();
	protected $table 				= 'guestbooks';
    protected $primaryKey 			= 'id';
    protected $fillable = [
        'name', 'phone', 'email', 'nature', 'isContacted', 'ip',
    ];
    protected $rules = array(
        'name'          => 'bail|required|regex:/^[a-zA-Z0-9\s]+$/|max:255|min:2',
        'phone'         => 'bail|required|alpha_num|min:6|max:16',
        'email'         => 'bail|required|email|max:255',
        'nature'        => 'bail|required|regex:/^[a-zA-Z0-9\s]+$/|max:255|min:90',
        'isContacted'   => 'boolean',
        'ip'            => 'required'
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
