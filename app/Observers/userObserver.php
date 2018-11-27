<?php

namespace App\Observers;
use Validator, Hash;
use App\Models\User;

class userObserver extends User
{   
    public static function saving($model){
        $ori = $model->getOriginal();

        // validate
		$v = Validator::make($model->attributes, $model->rules);

		// check for failure
		if ($v->fails())
		{
            // old data ?
            if($ori){
                //exceptions
                $err = $v->errors();

                // name
                if($err->first('name')){
                    if($model['name'] != $ori['name']){
                        // set errors and return false
                        $model->setError([$err->first('name')]);
                        return false;
                    }
                }

                // username check
                if($err->first('username')){
                    if($model['username'] != $ori['username']){
                        // set errors and return false
                        $model->setError([$err->first('username')]);
                        return false;
                    }
                }

                // password check
                if($err->first('password')){
                    if($model['password'] != $ori['password']){
                        // set errors and return false
                        $model->setError([$err->first('password')]);
                        return false;
                    }
                }
            }else{
                // set errors and return false
                $model->setError($v->errors());
                return false;
            }
		}

        // hash pwd
        if($model['password']){
            $model['password'] = Hash::make($model['password']);
        }else{
            $model['password'] = $ori['password'];
        }

		return true;
    }


    public static function deleting($model){
        if($model->id == 1){
            $model->setError(["Admin can't be deleted"]);
			return false;
        }
    }

}
