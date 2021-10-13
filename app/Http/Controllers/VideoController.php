<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\VideoUploaded;
use App\Models\Video;
use Storage;
use Validator;

class VideoController extends Controller
{
	public function index() {

		$videos = Video::converted()->orderBy('id', 'desc')->get();
		return view('videos', compact('videos'));
	}

	public function play($id) {

		$video = Video::find($id);
		return view('player', compact('video'));
	}

	public function upload(Request $request)
	{
		// validate data
        $validator = Validator::make($request->all(),
            [
                'title' => 'required|max:255',
                'file' =>'mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:100040|required'
            ]
        );

        if ($validator->fails()){
             return redirect()
		         ->back()
		         ->withErrors($validator)
		         ->withInput();
         }	

        try {
        	$video = new Video;
			$video->title = $request->title;
			$metaData = [];
			if ($request->hasFile('file'))
			{
				$media = $request->file('file');
				$path = $media->store(
				    'videos', 'public'
				);
				$video->file = $path;
				$metaData['size'] = $media->getSize();
				$metaData['mime-type'] = $media->getMimeType();
			}

			$video->metadata = json_encode($metaData);
			$video->save();

			//Dispatch the video uploaded event
			VideoUploaded::dispatch($video);

			return redirect()->route('videos')->with(['message' => 'Video successfully uploaded!']);
        }
        catch (\Exception $e) {
        	return redirect()->route('task')->with(['message' => 'Something went wrong!']);
        }

		
	}
}
