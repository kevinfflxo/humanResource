<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Response;

class ImageController extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth:admin', 'web']);
    }
    
    public function displayImage($filename)
    {
    	$path = storage_path('app/photos/'.$filename);
    	if (!File::exists($path)) {
        	abort(404);
	    }

	    $file = File::get($path);
	    $type = File::mimeType($path);
	    $response = Response::make($file, 200);
	    $response->header("Content-Type", $type);
	    return $response;
	}
}
