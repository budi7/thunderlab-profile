<?php

namespace App\Http\Controllers;

// use Response;
use Illuminate\Http\Request;
use Response, Input;


class mediaController extends Controller
{
    private function upload($file, $folder = null, $filename = null){
        // get original filename
        if($filename){
            $imageName = $filename.'.'.request()->image->getClientOriginalExtension();
        }else{
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
        }

        // group by folder if needed
        if($folder){
            // check if directory exist
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }
        }

        // define image path
        $imagePath = public_path('img') . ($folder ? ( "/" . $folder . "/" ) : "");

        // save image
        request()->image->move($imagePath, $imageName);

        // return filename
        return asset("img/". ($folder ? ( $folder . "/" ) : ""). $imageName);
    }

    //
    public function uploadImagePortofolio(Request $request){
        // $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        $result = $this->upload($request, "Portofolio");

        return Response::json([
            'url' => asset($result)
        ], 200);
    }

    public function uploadImageWebcore(Request $request){
        // $request->validate([
        //     'image' => 'required|image|mimes:png|max:2048',
        // ]);
        $result = $this->upload($request, 'Temp', "logo");

        return Response::json([
            'url' => asset($result)
        ], 200);
    }
}
