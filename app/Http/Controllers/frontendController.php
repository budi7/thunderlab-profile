<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portofolio;
use App\Models\Career;
use App\Models\Guestbook;
use App\Models\Core;
use Carbon\Carbon;
use App\Http\Traits\recaptchaTrait;

class frontendController extends Controller {
    use recaptchaTrait;

    private function getSettings(){
        $core                               = Core::where("key", "web_config")
                                                ->first();

        return json_decode($core['value']);
    }

    public function index() {
        // init : page attributes
		$this->page_attributes->title       = 'Home';
		$this->page_attributes->sub_title   = '';
        $this->page_attributes->filter      = null;
        $this->page_datas->page             = $this->getSettings();

        // views
        $this->view                         = view('pages.frontend.index');
        return $this->generateView(); 
    }

    public function portofolio() {
        // init : page attributes
		$this->page_attributes->title       = 'Portofolio';
		$this->page_attributes->sub_title   = '';
        $this->page_attributes->filter      = null;
        $this->page_datas->page             = $this->getSettings();
        

        $this->page_datas->years            =  Portofolio::select('year')
                                                ->distinct('year')
                                                ->get();

        $this->page_datas->datas            =  Portofolio::orderBy("year", 'desc')
                                                ->orderBy("title")
                                                ->get();
        // views
        $this->view                         = view('pages.frontend.portofolio');
        return $this->generateView(); 
    }   
    
    public function career() {
        // init : page attributes
		$this->page_attributes->title       = 'Career';
		$this->page_attributes->sub_title   = '';
        $this->page_attributes->filter      = null;
        $this->page_datas->page             = $this->getSettings();        

        $this->page_datas->types            =  Career::select('type')
                                                ->distinct('type')
                                                ->get();

        $this->page_datas->datas            =  Career::where('isAvailable', true)
                                                ->orderBy("updated_at", 'desc')
                                                ->get();                                                

        // views
        $this->view                         = view('pages.frontend.career');
        return $this->generateView(); 
    }   
    
    public function contacts() {
        // init : page attributes
		$this->page_attributes->title       = 'Contacts';
		$this->page_attributes->sub_title   = '';
        $this->page_attributes->filter      = null;
        $this->page_datas->page             = $this->getSettings();

        // views
        $this->view                         = view('pages.frontend.contacts');
        return $this->generateView(); 
    } 
    
    public function writeGuestbook(request $request) {
        $book = new Guestbook;
        $input = $request->input();

        // write to guest book
        $book->name = $input['name'];
        $book->phone = $input['phone'];
        $book->email = $input['email'];
        $book->nature = $input['nature'];
        $book->ip = \Request::ip();


        // validate captcha
        $result = recaptchaTrait::validateCaptcha($input['captcha']);
        if(!$result){
            // captcha not valid
            return response()->json([
                'code' => '500',
                'message' => 'Your captcha seems not valid. Please try again.',
            ]);
        }

        // check ip
        $ip_count = Guestbook::where('ip', $book->ip)
                        ->where('created_at', '>', Carbon::yesterday())
                        ->count();

        if($ip_count > 0){
            return response()->json([
                'code' => '77',
                'message' => 'You only allowed one request per day.</br>Please kindly reach us for fast response.',
            ]);
        }

        // save db
        try{
            $book->save();
            $this->page_attributes->msg['error'] = $book->getErrors();
        }catch(\Illuminate\Database\QueryException $ex){
            $this->page_attributes->msg['error'] = [$ex->getMessage()];
        }

        if($this->page_attributes->msg['error']){
            return response()->json([
                'code' => '500',
                'message' => 'We are having problem to precessing your request.</br>Make sure you correctly enter your information and please try again.',
                'detail' =>  $this->page_attributes->msg['error']
            ]);
        }
        
        return response()->json([
            'code' => '200',
            'message' => 'Thank you, one of our team members will contact you shortly.',
        ]);
    }  
}
