<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function save_photo(Request $request){
        // return request();
        // return $request->photo;
        $image_name = time().'.'.$request->photo->getClientOriginalExtension();
        $request->photo->move(public_path('images'),$image_name);
        $photo = new Photo;
        $photo->title = $request->title;
        $photo->photo = $image_name;
        $photo->save();
        return response()->json(['message'=>'Photo added successfully']);
    }
}
