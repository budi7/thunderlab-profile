<?php

namespace App\Observers;
use App\Models\Guestbook;
use Validator;

class guestBookObserver extends Guestbook
{   
    public static function saving($model){
        // validate
		$v = Validator::make($model->attributes, $model->rules);

		// check for failure
		if ($v->fails())
		{
            // set errors and return false
            $model->setError($v->errors());
            return false;
		}

		return true;
    }

    public static function updating($model){
        $ori = $model->getOriginal();
        
        if($ori['isContacted'] == true){
            $model->setError(["Guest allready contacted"]);
            return false;
        }
    }
}
