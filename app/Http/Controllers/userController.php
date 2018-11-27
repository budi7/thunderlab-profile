<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Input, Auth, Hash;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // init : page attributes
		$this->page_attributes->title       = 'User';
		$this->page_attributes->sub_title   = 'Index';
        $this->page_attributes->filter      =   null;

        $this->page_datas->datas            = User::paginate();
        
        // views
        $this->view                         = view('pages.backend.user.index');
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
		$this->page_attributes->title       = 'User';
		$this->page_attributes->sub_title   = $id ? "Edit Data" : "New Data";
        $this->page_attributes->filter      = null;

        $this->page_datas->datas            = $id ? User::find($id) : [];
        $this->page_datas->id               = $id;

        // views
        $this->view                         = view('pages.backend.user.create');
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
        $user = user::findOrNew($id);
                    
        // fill input
        $user['name'] = Input::get('name');
        $user['username'] = Input::get('username');
        $user['password'] = Input::get('password');
        $user['role'] =  $user['role'] ?  $user['role'] : "Writer";
               
        // save data
        try{
            $user->save();
            $this->page_attributes->msg['error'] = $user->getErrors();
        }catch(\Illuminate\Database\QueryException $ex){
            $this->page_attributes->msg['error'] = [$ex->getMessage()];
        }
        
        // return view
        $this->page_attributes->msg['success'] = 'Data successfully saved';
        
        if($id){
            return $this->generateRedirect(route('backend.user.show', ['id' => $id]));
        }
        
        return $this->generateRedirect(route('backend.user.index'));
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
		$this->page_attributes->title       = 'User';
		$this->page_attributes->sub_title   = 'Detail';
        $this->page_attributes->filter      =  null;

        $this->page_datas->datas            = User::find($id);
        $this->page_datas->id               = $id;
        
        // views
        $this->view                         = view('pages.backend.user.show');
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
        $user = User::findOrFail($id);
        $user->delete();

        // return view
        $this->page_attributes->msg['success'] = 'Data Successfully Deleted';
       
        return $this->generateRedirect(route('backend.user.index'));
    }


    public function updatePassword(Request $request){
        // find & validate user + password
		if (!Auth::attempt( ['username' => Auth::user()['username'], 'password' => Input::get('old-password')] ))  {			
            // abort
            $this->page_attributes->msg['error'] = ['Incorrect old password'];
            return $this->generateRedirect(route('backend.me'));
        }

        $user             = User::findOrFail(Auth::user()['id']);

        // vlidate password
        if(Input::get('new-password') == Input::get('old-password')){
            // abort
            $this->page_attributes->msg['error'] = ['Old password and New password must not same'];
            return $this->generateRedirect(route('backend.me'));
        }

        // update new pasword
        $user['password'] = Input::get('new-password');

         // save data
         try{
            $user->save();
            $this->page_attributes->msg['error'] = $user->getErrors();
        }catch(\Illuminate\Database\QueryException $ex){
            $this->page_attributes->msg['error'] = [$ex->getMessage()];
        }
        
        // return view
        $this->page_attributes->msg['success'] = 'Password successfully updated';
                
        return $this->generateRedirect(route('backend.me'));
    }
}
