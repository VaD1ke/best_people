<?php namespace App\Http\Controllers;

use Request;

class RegController extends Controller {

    public function showReg()
    {
        return view('registration');
    }

    public function regUser()
    {
        $data = Request::all();

        return $data;
    }

}
