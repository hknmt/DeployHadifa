<?php

namespace App\Http\Controllers;

use App\Media;

use Illuminate\Http\Request;
use Validator;
use Filesystem;
use Image;
use Storage;
use URL;
use Carbon\Carbon as Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreFileRequest;

class ServiceFilemanager extends Controller
{
    public function Index()
    {
        
        
    	return view('Upload.index');

    }

    public function ListFile()
    {

        $images = Media::all()->sortByDesc('created_at');

        return response()->json([
            'images' => $images
        ], 200);

    }

    public function Store(StoreFileRequest $request)
    {
        
        if($request->ajax()) {
            $files = $request->file('image');
            $storage = $this->Separator(public_path().'/uploads/images/');
            foreach($files as $value) {
                $name = $value->getClientOriginalName();
                $mime = $value->getClientMimeType();
                $path = $storage.explode('.', $name)[0].'.'.explode('/', $mime)[1];
                if(file_exists($path)) {
                    return response()->json([
                        'messenger' => 'File '.$name.' đã có trên hệ thống'
                    ], 200);
                } else {
                    $value->move($storage, explode('.', $name)[0].'.'.explode('/', $mime)[1]);
                    $image = new Media([
                        'name' => explode('.', $name)[0],
                        'mime_type' => $mime,
                        'link' => URL::asset('uploads/images/'.explode('.', $name)[0].'.'.explode('/', $mime)[1])
                    ]);
                    $image->save();
                }
            }

            return response()->json([
                'messenger' => 'Upload thành công!'
            ], 200);
        }

    }

    public function Destroy(Request $request)
    {

        if($request->ajax()) {
            $name = $request->name;
            $mime = explode('/', $request->mime);
            $path = $this->Separator(public_path().'/uploads/images/'.$name.'.'.$mime[1]);
            if(file_exists($path)){
                unlink($path);
                $media = Media::where('name', $name)->delete();

                return response()->json([
                    'messenger' => 'Xóa file thành công'
                ], 200);
            } else {
                return response()->json([
                    'messenger' => 'Xóa file không thành công'.$path
                ], 200);
            }

        }

    }

    protected function Separator($str)
    {
        $uname = php_uname();
        if(stripos($uname, 'windows'))
            return $str;
        else
            return str_replace('/', '\\', $str);
    }

    protected function Compare($arr1, $arr2)
    {

        if($arr1['time'] > $arr2['time'])
            return 1;
        else if($arr1['time'] == $arr2['time'])
            return -1;
        else
            return -1;

    }

}
