<?php

namespace App\Http\Controllers;

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

    public function index($dir, $prev_dir)
    {
    	$images = Image::where('parent', $dir)->paginate(12);
      $folders = Folder::where('parent', $dir)->get();
      $prev_dir = $dir;

    	return view('admin.media')->with('images', $images)->with('folders', $folders)->with('dir', $dir)->with('prev_dir', $prev_dir);
    }

    public function storeImage(Request $request)
    {
    	$this->validate($request, [
    		'image' => 'required | image',
        'dir' => 'required',
        'prev_dir' => 'required',
    	]);
      
      $dir = $request->input('dir');
      $prev_dir = $request->input('prev_dir');

    	$fileName = time()."_".$request->file('image')->getClientOriginalName();
      $path = $request->file('image')->storeAs('public/media_uploads', $fileName);

      $image = new Image;
      $image->timeStamp = time();
      $image->fileName = $fileName;
      $image->parent = $dir;
      $image->url = '/storage/media_uploads/'.$fileName;
      $image->save();
      
      return redirect('/admin/images/'.$dir.'/'.$prev_dir);
    }

    public function delete($fileName)
    {
    	$path = Storage::delete('public/media_uploads/'.$fileName);
    	$image = Image::where('fileName', $fileName)->delete();

    	return redirect('/admin/images');
    }

    public function addFolder(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'dir' => 'required',
            'prev_dir' => 'required'
        ]);

        $check = Folder::where('name', $request->input('name'))->where('parent', $request->input('dir'))->get();

        if(count($check) == 0) {
          $folder = new Folder;
          $folder->name = $request->input('name');
          $folder->parent = $request->input('dir');
          $folder->unique_id = time()."_".Auth::user()->name;
          $folder->save();          
        } else {
          return back();
        }
        return redirect('/admin/images/'.$request->input('dir').'/'.$request->input('prev_dir'));
    }

    public function deleteFolder ($id)
    {
      $folders = Folder::where('parent', $id)->delete();
      $folder = Folder::where('unique_id', $id)->delete();

      return back();
    }

    public function deleteImage($fileName)
    {

    }
}
