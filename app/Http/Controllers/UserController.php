<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Photo;
use App\Model\Gallery;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('profile');
    }

}
