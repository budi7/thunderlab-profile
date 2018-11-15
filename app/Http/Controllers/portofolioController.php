<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portofolio;
use Input;

class portofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // init : page attributes
		$this->page_attributes->title       = 'Portofolio';
		$this->page_attributes->sub_title   = 'Index';
        $this->page_attributes->filter      =  null;

        $this->page_datas->datas            = Portofolio::paginate();
        
        // views
        $this->view                         = view('pages.backend.portofolio.index');
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
		$this->page_attributes->title       = 'Portofolio';
		$this->page_attributes->sub_title   = $id ? "Edit Data" : "New Data";
        $this->page_attributes->filter      = null;

        $this->page_datas->datas            = $id ? Portofolio::findOrFail($id) : [];
        if($this->page_datas->datas){
            $this->page_datas->datas['client'] = json_decode($this->page_datas->datas['client'], true);
        }

        $this->page_datas->id               = $id;

        // views
        $this->view                         = view('pages.backend.portofolio.create');
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
        $portofolio = portofolio::findOrNew($id);
                            
        // fill input
        $portofolio['title'] = Input::get('title');
        $portofolio['year'] = Input::get('year');
        $portofolio['cover'] = Input::get('cover');
        $portofolio['description'] = Input::get('description');
        $portofolio['client'] = json_encode([
            'name' => Input::get('client_name'),
            'logo' => Input::get('client_logo'),
            'description' => Input::get('client_description'),
        ]);

        // save data
        try{
            $portofolio->save();
            $this->page_attributes->msg['error'] = $portofolio->getErrors();
        }catch(\Illuminate\Database\QueryException $ex){
            $this->page_attributes->msg['error'] = [$ex->getMessage()];
        }

        // return view
        $this->page_attributes->msg['success'] = 'Data successfully saved';

        if($id){
            return $this->generateRedirect(route('backend.portofolio.show', ['id' => $id]));
        }

        return $this->generateRedirect(route('backend.portofolio.index'));
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
		$this->page_attributes->title       = 'Portofolio';
		$this->page_attributes->sub_title   = 'Detail';
        $this->page_attributes->filter      =  null;

        $this->page_datas->datas            = Portofolio::findOrFail($id);
        if($this->page_datas->datas){
            $this->page_datas->datas['client'] = json_decode($this->page_datas->datas['client'], true);
        }
        $this->page_datas->id               = $id;
        
        // views
        $this->view                         = view('pages.backend.portofolio.show');
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
        $user = Portofolio::findOrFail($id);
        $user->delete();

        // return view
        $this->page_attributes->msg['success'] = 'Data Successfully Deleted';
       
        return $this->generateRedirect(route('backend.portofolio.index'));
    }
}
