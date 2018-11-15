<?php

namespace App\Models;
use Eloquent;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

	protected $guarded 				= array();
	protected $table 				= 'users';
    protected $primaryKey 			= 'id';
    protected $fillable = [
        'username', 'password',
    ];
    protected $rules = array(
        'name'     => 'required',
        'username' => 'required|email|unique:users|max:255',
        'password' => 'required|min:6|max:15',
    );
    protected $hidden = [
        'password',
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
