<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{

    /**
    * The main stuff of the app
    * with this we init the work
    *
    * @return \Illuminate\Http\Response
    */

    public function init()
    {
      return view('init');
    }
}
