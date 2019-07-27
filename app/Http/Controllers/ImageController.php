<?php

namespace App\Http\Controllers;
use App\FileUpload;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        if($request->get('image'))
        {
            $image = $request->get('image');
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->get('image'))->save(public_path('images/').$name);

            $image= new FileUpload();
            $image->image_name = $name;
            $image->save();

            return $image;
        } else {
            return null;
        }

     }
}
