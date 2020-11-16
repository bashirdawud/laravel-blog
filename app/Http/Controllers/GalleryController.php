<?php

namespace App\Http\Controllers;

use App\Gallery;
use Auth;
use Session;
use Storage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::orderBy('id', 'desc')->get();
        return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image_url' => 'required',
        ],
        [
            'image_url.required' => 'Select image'
        ]);
        
        foreach($request->image_url as $image_url){
            // get file with extention
            $fileNameWithExt = $image_url->getClientOriginalName();
            // get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // get just file extention
            $fileExt = $image_url->getClientOriginalExtension();
            // get file name to store 
            $fileNameToStore = $fileName. '_'.time(). '.' . $fileExt;

            $gallery = new Gallery();
            $gallery->user_id = Auth::id();
            $gallery->image_url = $fileNameToStore;
            $save = $gallery->save();

            if($save) {
                $image_url->storeAs('public/galleries/', $fileNameToStore);

            }
        }

        Session::flash('message', 'Image uploaded successfully');
        return redirect()->route('galleries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        // Delete image file
        Storage::delete('public/galleries'. $gallery->image_url);
        // delete data from table
        $gallery->delete();
        Session::flash('delete-msg', 'Image deleted');
        return redirect()->back();
    }
}
