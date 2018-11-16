<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guestbook;

use Analytics, Period;
use Carbon\Carbon;

class dashboardController extends Controller
{
    //
    public function index()
    {
        // init : page attributes
		$this->page_attributes->title       = 'Dashboard';
		$this->page_attributes->sub_title   = '';
        $this->page_attributes->filter      =  null;

        // Get guestbook data
        $this->page_datas->analytics        = $this->getAnalytics();  
    
        // Get guestbook data
        $this->page_datas->guestbooks       = Guestbook::where('isContacted', null)
                                                ->orderBy('created_at', 'desc')
                                                ->paginate();

        // views
        $this->view                         = view('pages.backend.dashboard');
        return $this->generateView(); 
    }

    private function getAnalytics(){
        // Get analytics data
        $analytics = Analytics::fetchVisitorsAndPageViews(Period::days(7));

        if(!$analytics){
            return response()->json([
                'code' => '500',
                'data' => null
            ]);
        }
        
        // format data
        $formatted_data = [];
        foreach ($analytics as $key => $analytic) {
            $tmp_date = Carbon::createFromFormat('Y-m-d H:i:s', $analytic['date'], 'GMT+7');

            $tmp = [
                'date' => $tmp_date->format("d M Y"),
                'visitors' => $analytic['visitors'],
                'pageViews' => $analytic['pageViews'],
            ];
            array_push($formatted_data, $tmp);
        }

        return $formatted_data;
    }

    
}
