<?php

namespace App\Observers;
use App\Models\Career;
use Validator;

class coreObserver extends Career
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
}
