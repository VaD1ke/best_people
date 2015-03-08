<?php namespace App\Http\Controllers;

use App\User;

class MainController extends Controller
{

    public function index()
    {
        $users = User::all()->sortByDesc('mark_sum')
            ->take(15);

        return view('main', ['users' => $users]);
    }

}
