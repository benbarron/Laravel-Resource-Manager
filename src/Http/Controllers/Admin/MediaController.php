<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;
use App\Image;
use Auth;
use App\Folder;

class MediaController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
      $images = Image::all();

      return view('admin.media')->with('images', $images);
    }

    public function storeImage(Request $request)
    {
      $this->validate($request, [
        'image' => 'required | image',
      ]);

      $dir = $request->input('dir');
      $prev_dir = $request->input('prev_dir');

      $fileName = time()."_".$request->file('image')->getClientOriginalName();
      $path = $request->file('image')->storeAs('public/media_uploads', $fileName);

      $image = new Image;
      $image->timeStamp = time();
      $image->fileName = $fileName;
      $image->parent = '';
      $image->url = '/storage/media_uploads/'.$fileName;
      $image->save();

      return redirect('/admin/media')->with('green', $fileName.' was saved to /storage/media_uploads');
    }

   
    public function deleteImage($fileName)
    {
      $image = Image::where('fileName', $fileName)->delete();
      $path = Storage::delete('public/media_uploads/'.$fileName);

      return redirect('/admin/media')->with('green', $fileName.' was deleted');
    }
}
