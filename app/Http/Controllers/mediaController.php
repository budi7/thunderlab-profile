<?php

namespace App\Http\Controllers;

// use Response;
use Illuminate\Http\Request;
use Response, Input;


class mediaController extends Controller
{
    //
    public function uploadImagePortofolio(Request $request){
        // $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('img'), $imageName);

        return Response::json([
            'url' => asset("img/" . $imageName)
        ], 200);
    }
    
}
