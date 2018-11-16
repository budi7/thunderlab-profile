<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Core;
use Input, Storage;

class configController extends Controller
{
    public function create($id = null)
    {
        // init : page attributes
		$this->page_attributes->title       = 'Configuration';
		$this->page_attributes->sub_title   = null;

        $this->page_datas->id               = $id;

        $core                               = Core::where("key", "web_config")
                                                ->first();

        $this->page_datas->datas            = json_decode($core['value']);
        // dd($this->page_datas->datas);
        
        // views
        $this->view                         = view('pages.backend.core.config');
        return $this->generateView();          
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // save image
        if (file_exists("../public/img/Temp/logo.png")) {
            rename('../public/img/Temp/logo.png', '../public/img/logo.png');
            copy('../public/img/logo.png', '../public/img/logo@2x.png');
        }

        // save config
        $core = Core::where("key", "web_config")
                    ->first();
        if(!$core){
            $core = new Core;
        }

        $val = [];
        $val['name'] = Input::get('name');
        $val['description'] = Input::get('description');
        $val['email'] = Input::get('email');
        $val['phone'] = Input::get('phone');
        $val['address'] = Input::get('address');
        $val['operational'] = Input::get('operational');
        $val['facebook'] = Input::get('facebook');
        $val['instagram'] = Input::get('instagram');
        $val['twitter'] = Input::get('twitter');

        $core->key = "web_config";
        $core->value = json_encode($val);

        // saving
        try{
            $core->save();
            $this->page_attributes->msg['error'] = $core->getErrors();
        }catch(\Illuminate\Database\QueryException $ex){
            $this->page_attributes->msg['error'] = [$ex->getMessage()];
        }

        // return view
        $this->page_attributes->msg['success'] = 'Data successfully saved';

        return $this->generateRedirect(route('backend.config.create'));
    }
}
