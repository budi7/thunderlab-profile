<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guestbook;

use Analytics, Period;

class dashboardController extends Controller
{
    //
    public function index()
    {
        // init : page attributes
		$this->page_attributes->title       = 'Dashboard';
		$this->page_attributes->sub_title   = '';
        $this->page_attributes->filter      =  null;
        
        // Get analytics data
        $anal = Analytics::fetchVisitorsAndPageViews(Period::days(7));

        // Get guestbook data
        $this->page_datas->guestbooks       = Guestbook::where('isContacted', null)
                                                ->orderBy('created_at', 'desc')
                                                ->paginate();

        // views
        $this->view                         = view('pages.backend.dashboard');
        return $this->generateView(); 
    }

    
}
