<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guestbook;

class guestbookController extends Controller
{
    public function index()
    {
        // init : page attributes
		$this->page_attributes->title       = 'Guest Book';
		$this->page_attributes->sub_title   = 'Index';
        $this->page_attributes->filter      =   null;

        $this->page_datas->datas            = Guestbook::orderBy('created_at', 'desc')
                                                ->orderBy('isContacted')
                                                ->paginate();

        // views
        $this->view                         = view('pages.backend.guestbook.index');
        return $this->generateView();   
    }

    public function create($id = null)
    {
        return $this->index();
    }

    public function store(Request $request)
    {
        return $this->index();
    }

    public function show($id){
        // init : page attributes
		$this->page_attributes->title       = 'Guestbook';
		$this->page_attributes->sub_title   = 'Detail';
        $this->page_attributes->filter      =  null;

        $this->page_datas->datas            = Guestbook::findOrFail($id);
        $this->page_datas->id               = $id;
        
        // views
        $this->view                         = view('pages.backend.guestbook.show');
        return $this->generateView(); 
    }

    public function edit($id)
    {
        $book                               = Guestbook::find($id);
        $book['isContacted'] = true;

        // save data
        try{
            $book->save();
            $this->page_attributes->msg['error'] = $book->getErrors();
        }catch(\Illuminate\Database\QueryException $ex){
            $this->page_attributes->msg['error'] = [$ex->getMessage()];
        }
        
        // return view
        $this->page_attributes->msg['success'] = 'Data successfully updated';
        
        return $this->generateRedirect(route('backend.guestbook.show', ['id' => $id]));
    }

    public function update($id)
    {
        return $this->index();
    }

    public function destroy($id)
    {
        $user = Guestbook::findOrFail($id);
        $user->delete();

        // return view
        $this->page_attributes->msg['success'] = 'Data Successfully Deleted';
       
        return $this->generateRedirect(route('backend.guestbook.index'));
    }
}
