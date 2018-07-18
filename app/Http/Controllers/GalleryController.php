<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Photo;
use App\Model\Gallery;
use Validator;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = Gallery::latest()->get();
        return view('gallery_list',  ['datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('gallery_create');
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
        $galleryname = $request->input('galleryname');
        $gallerydescription = $request->input('gallerydescription');
        $gallery = new Gallery();
        if($request->has('id')){
            $gallery = Gallery::findOrFail($request->input('id'));
        }

        $validator = Validator::make($request->all(), [
            'galleryname' => 'required|max:100',
            'gallerydescription' => 'required|max:100'
        ]);

        if ($validator->fails()) {
            //echo "false"; exit;
            return redirect()->back()
              ->withInput()
              ->withErrors($validator); 
        }

        $gallery->galleryname = $galleryname;
        $gallery->gallerydescription = $gallerydescription;
        $res = $gallery->save();        
        return redirect()->route('gallery.index');
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
        $gallery = Gallery::findOrFail($id);
        //var_dump(compact('photo')); exit;
        return view('gallery_edit', ['gallery' => $gallery]);        
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
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();
        return redirect()->route('gallery.index');
    }
}
