<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Image;
use Auth;

class MediaController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
    	$images = Image::paginate(12);
    	return view('admin.media')->with('images', $images);
    }

    public function storeImage(Request $request)
    {
    	$this->validate($request, [
    		'image' => 'required | image'
    	]);

    	$fileName = time()."_".$request->file('image')->getClientOriginalName();
      $path = $request->file('image')->storeAs('public/media_uploads', $fileName);

      $image = new Image;
      $image->timeStamp = time();
      $image->fileName = $fileName;
      $image->url = '/storage/media_uploads/'.$fileName;
      $image->save();
      
      return redirect('/admin/images');
    }

    public function delete($fileName)
    {
    	$path = Storage::delete('public/media_uploads/'.$fileName);
    	$image = Image::where('fileName', $fileName)->delete();

    	return redirect('/admin/images');
    }
}
