<?php namespace App\Http\Controllers;

use \App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller {

    public function getUser($id)
    {
        $id = (int)$id;

        $user = User::get($id);
        $rating = $user->votes->sum('mark');

        if ($user instanceof ModelNotFoundException)
        {
            return 'Oops. Page not found';
        } else {
            //return
            return view('user', ['user' => $user, 'rating' => $rating]);
        }
    }

    public function regUser()
    {
        $data = Input::all();

        return $data;
    }

}