<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Career;
use Input;

class careerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // init : page attributes
		$this->page_attributes->title       = 'Career';
		$this->page_attributes->sub_title   = 'Index';
        $this->page_attributes->filter      =  null;

        $this->page_datas->datas            = Career::OrderBy('updated_at', 'desc')
                                                ->paginate();
        
        // views
        $this->view                         = view('pages.backend.career.index');
        return $this->generateView(); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        // init : page attributes
		$this->page_attributes->title       = 'Career';
		$this->page_attributes->sub_title   = $id ? "Edit Data" : "New Data";
        $this->page_attributes->filter      = null;

        $this->page_datas->datas            = $id ? Career::findOrFail($id) : [];

        $this->page_datas->id               = $id;

        // views
        $this->view                         = view('pages.backend.career.create');
        return $this->generateView();     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id = null)
    {
        // Database
        $career = career::findOrNew($id);
                                    
        // fill input
        $career['title'] = Input::get('title');
        $career['type'] = Input::get('type');
        $career['location'] = Input::get('location');
        $career['description'] = Input::get('description');
        $career['responsibilities'] = Input::get('responsibilities');
        $career['requirements'] = Input::get('requirements');
        $career['isAvailable'] = Input::get('isAvailable');

        // save data
        try{
            $career->save();
            $this->page_attributes->msg['error'] = $career->getErrors();
        }catch(\Illuminate\Database\QueryException $ex){
            $this->page_attributes->msg['error'] = [$ex->getMessage()];
        }

        // return view
        $this->page_attributes->msg['success'] = 'Data successfully saved';

        if($id){
            return $this->generateRedirect(route('backend.career.show', ['id' => $id]));
        }

        return $this->generateRedirect(route('backend.career.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // init : page attributes
		$this->page_attributes->title       = 'Career';
		$this->page_attributes->sub_title   = 'Detail';
        $this->page_attributes->filter      =  null;

        $this->page_datas->datas            = Career::findOrFail($id);
        $this->page_datas->id               = $id;
        
        // views
        $this->view                         = view('pages.backend.career.show');
        return $this->generateView(); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return $this->create($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        return $this->store($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = Career::findOrFail($id);
        $user->delete();

        // return view
        $this->page_attributes->msg['success'] = 'Data Successfully Deleted';
       
        return $this->generateRedirect(route('backend.career.index'));
    }
}
