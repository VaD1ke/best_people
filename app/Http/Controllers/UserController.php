<?php namespace App\Http\Controllers;

use Auth;
use File;
use Hash;
use Exception;
use Request;
use Validator;
use \App\Comment;
use \App\Vote;
use \App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Intervention\Image\ImageManagerStatic as Image;


class UserController extends Controller
{

    public function authenticate()
    {

        $data = Request::all();

        $rules = [
            'login'                => 'required|exists:users',
            'password'             => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ];

        $val = Validator::make($data, $rules);

        if ($val->fails()) {
            return redirect('/login')->withErrors($val);
        }

        if (Auth::attempt(['login' => $data['login'], 'password' => $data['password']], true)) {
            return redirect('/');
        } else {
            return redirect('/login')->withErrors(array('password' => 'Неверный пароль'))
                    ->withInput(Request::except('password'));
        }

    }


    public function edit()
    {
        $data = Request::all();

        $rules = ['avatar' => 'mimes:jpeg,gif,png|max:5120'];

        $val = Validator::make($data, $rules);

        if ($val->fails()) {
            return redirect('/edit')->withErrors($val);
        }

        $user = Auth::user();


        if (Request::hasFile('avatar')) {

            $file = Request::file('avatar');

            $oldFile = Auth::user()->image_path;

            $image = Image::make($file);

            $width = $image->width();
            $height = $image->height();


            if ($oldFile !== 'media/photo/male_default.png' && $oldFile !== 'media/photo/female_default.png') {
                File::delete($oldFile);
            }

            if ($width !== 50 || $height !== 50) {
                $image->resize(50, 50);
            }

            $ext = $file->getClientOriginalExtension();
            $name = sha1($user->id . '_' . $user->login) . '.' . $ext;
            $image->save('media/photo/' . $name);

            $user->image_path = 'media/photo/' . $name;

        }

        $user->sex = $data['sex'];
        $user->save();

        return redirect('/');
    }


    public function getUser($id)
    {
        $id = (int)$id;

        $user = User::get($id);

        if ($user instanceof ModelNotFoundException) {

            return 'Oops. Page not found';

        } else {

            $user->comments->sortBy('created_at');

            return view('user', ['user' => $user]);

        }
    }


    public function leftComment($id)
    {
        if (Auth::check()) {
            $data = Request::all();

            $rules = ['comment_text' => 'required|max:1000'];
            $val = Validator::make($data, $rules);

            if ($val->fails()) {
                return redirect('/user/' . $id)->withErrors($val);
            }

            $data['id'] = $id;
            $data['who_left'] = Auth::user()->id;
            $comment = Comment::add($data);

            if ($comment instanceof Exception) {

                return 'Oops. Something is wrong';

            }

            return redirect('/user/' . $id);
        }
    }


    public function register()
    {
        $data = Request::all();

        $rules = [
            'login'    => 'required|between:4,15|unique:users|regex:/^[a-zA-Z0-9]+$/',
            'password' => 'required|between:5,25|alpha_num|regex:/^.*(?=.*\d)(?=.*[a-zA-Z]).*$/',
            'avatar'   => 'mimes:jpeg,gif,png|max:5120'
        ];
        $val = Validator::make($data, $rules);

        if ($val->fails()) {
            return redirect('/registration')->withErrors($val);
        }

        $user = User::add($data);

        if ($user instanceof Exception) {

            return 'Oops. Something is wrong';

        }

        if (Request::hasFile('avatar')) {

            $file = Request::file('avatar');

            $image = Image::make($file);

            $width = $image->width();
            $height = $image->height();

            if ($width !== 50 || $height !== 50) {
                $image->resize(50, 50);
            }

            $ext = $file->getClientOriginalExtension();
            $name = sha1($user->id . '_' . $user->login) . '.' . $ext;
            $image->save('media/photo/' . $name);

            $user->image_path = 'media/photo/' . $name;
            $user->save();
        }
        Auth::login($user, true);

        return redirect('/');
    }


    public function voteUp()
    {
        $data = Request::all();

        $data['mark'] = 1;

        Vote::add($data);
    }


    public function voteDown()
    {
        $data = Request::all();

        $data['mark'] = -1;

         Vote::add($data);
    }

}
