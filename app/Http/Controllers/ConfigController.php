<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Core;
use Input;

class ConfigController extends Controller
{
    public function create($id = null)
    {
        // init : page attributes
		$this->page_attributes->title       = 'Configuration';
		$this->page_attributes->sub_title   = null;

        $this->page_datas->datas            = $id ? Core::find($id)->first() : [];
        $this->page_datas->id               = $id;

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
        //
    }

}
