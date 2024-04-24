<?php

namespace App\Modules\Action\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActionController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Action::welcome");
    }
}
