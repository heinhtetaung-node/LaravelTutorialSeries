<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Photo;
use App\Model\Gallery;
use Validator;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        // 1st way 
        // $datas = Photo::latest()->with('gallery')->get();

        // 2nd way
        $datas = Photo::selectRaw('photos.*, gallery.galleryname AS galleryname')
                        ->leftJoin('gallery', 'gallery.id', '=', 'photos.gallery_id')
                        ->latest()->get();

        return view('photo_list',  ['datas' => $datas]);
    }

    public function save(Request $req){
        echo $req->input('photoname');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $datas = Gallery::latest()->get();
        return view('photo_create', ['gallery' => $datas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $photoname = $request->input('photoname');
        $description = $request->input('description');
        $photo = new Photo();
        if($request->has('id')){
            $photo = Photo::findOrFail($request->input('id'));
        }

        $validator = Validator::make($request->all(), [
            'photoname' => 'required|max:100',
            'description' => 'required|max:100'
        ]);

        if ($validator->fails()) {
            //echo "false"; exit;
            return redirect()->back()
              ->withInput()
              ->withErrors($validator); 
        }

        $photo->photoname = $photoname;
        $photo->description = $description;
        $photo->gallery_id = $request->get('gallery_id');
        $res = $photo->save();        
        return redirect()->route('photos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $photo = Photo::findOrFail($id);
        //var_dump(compact('photo')); exit;
        $galleryoptions = Gallery::latest()->get();        

        return view('photo_edit', ['photo' => $photo, 'gallery' => $galleryoptions]);        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $photo = Photo::findOrFail($id);
        $photo->delete();
        return redirect()->route('photos.index');
    }
}
