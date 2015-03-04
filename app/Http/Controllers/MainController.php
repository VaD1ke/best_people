<?php namespace App\Http\Controllers;

use App\User;

class MainController extends Controller{

    public function index()
    {
        //$users = User::getAllOrder();
        $users = User::all()->sortBy('mark_sum');

        //$users["rating"] = Vote::where('whom_voted_id', '=', $user->id)->sum();
        //return view('main')->with('users', $users);
        return view('main', ['users' => $users]);
        //return view('main')->with($users, $rating);
        //return view('main')->with('users', $users, 'rating', $rating);
    }

}