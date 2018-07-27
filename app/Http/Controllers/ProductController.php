<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Photo;
use App\Model\Gallery;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Photo::selectRaw('photos.*, gallery.galleryname AS galleryname')
                        ->leftJoin('gallery', 'gallery.id', '=', 'photos.gallery_id')
                        ->latest()->get();

        return view('shopping',  ['datas' => $datas]);
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

        $structure= "upload/photos/";
        $photourl="";
        if($request->file('photourl')!=NULL){

            $file = $request->file('photourl');
            
            if($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="JPG" || $file->getClientOriginalExtension()=="png" || $file->getClientOriginalExtension()=="PNG" || $file->getClientOriginalExtension()=="gif" || $file->getClientOriginalExtension()=="GIF"){
                
                $photourl = $file->getClientOriginalName();
                $file->move($structure, $photourl);                
            }
        }

        if($photourl!=""){
            $photo->photourl = $structure.$photourl;
        }

        $res = $photo->save();        
        return redirect()->route('photos.index');
    }


    public function addtocart($id, Request $request){
        //$id;

        // check in the session product is exist or not
        // get product array from session

        // if (sessionesist)
                // if(productexist)
                //      go ahead quantiy pls
                // else
                //      just save to session

                // update session
        // else
        //      create a new session
        //      just save product to session 


        // if($request->session()->has('carts')){  // checing session exist or not

        // $data=$request->session()->get('carts');   // get data from session

        // $request->session()->put('redirecturl', $request->redirecturl);   // save or update data in session

        // $request->session()->forget('carts');   // destroy session

        if($request->session()->has('carts')){

            $carts=$request->session()->get('carts');
            $key = $this->checkProductExist($carts, $id);
            if($key!=-1){  // product exist in session
                $carts[$key]['qty']++;
            }else{
                $photoarr = Photo::findOrFail($id);
                //$photoarr = compact('photoarr');
                array_push($carts, ['id' => $id, 'qty' => 1, 'productarr'=>['photoname'=> $photoarr->photoname, 'photourl'=>$photoarr->photourl]]);
            }
            $request->session()->put('carts', $carts);

        }else{

            $photoarr = Photo::findOrFail($id);
            //$photoarr = compact('photoarr');
            $carts = [['id' => $id, 'qty' => 1, 'productarr'=>['photoname'=> $photoarr->photoname, 'photourl'=>$photoarr->photourl]]];
            $request->session()->put('carts', $carts);
        }

        return $request->session()->get('carts');
    }

    public function checkProductExist($data, $id){
        $res = -1;
        foreach ($data as $key => $value) {
            if($value['id'] == $id){
                $res = $key;
                break;
            }
        }
        return $res;
    }

    public function showcarts(){
        return view('showcarts');
    }

    public function removeprd($index, Request $request){

        if($request->session()->has('carts')){            
            $carts=$request->session()->get('carts');
            array_splice($carts, $index, 1);
            
            $request->session()->put('carts', $carts);
        }

        return redirect('showcarts');
    }

    public function clearcart(Request $request){
        if($request->session()->has('carts')){            
            $request->session()->forget('carts');   
        }
        return redirect('showcarts');   
    }
}
