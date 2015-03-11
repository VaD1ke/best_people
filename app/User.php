<?php namespace App;

use Exception;
use Auth;
use Hash;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
	use Authenticatable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['login', 'password', 'image_path', 'sex'];

    //protected $guarded = ['id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    protected $with = ['votes', 'comments'];

    protected $appends = ['mark_sum'];


    public function leftComments()
    {
        return $this->hasMany('App\Comment', 'who_left_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'whom_left_id', 'id');
    }

    public function voted()
    {
        return $this->hasMany('App\Vote', 'who_voted_id', 'id');
    }

    public function votes()
    {
        return $this->hasMany('App\Vote', 'whom_voted_id', 'id');
    }

    public function getMarkSumAttribute()
    {
        return $this->votes->sum('mark');
    }

    public function getCommentDateAttribute()
    {
        return $this->comments->created_at;
    }

    public function isVotedFor($user)
    {
        foreach ($this->voted as $userVoted) {
            if ($userVoted->whom_voted_id === $user->id)
                return $userVoted->mark;
        }

        return 0;
    }


    public static function add($data)
    {

        $avatar = '';
        if ($data['sex'] == 1) {
            $avatar = "media/photo/male_default.png";
        } elseif ($data['sex'] == 2) {
            $avatar = "media/photo/female_default.png";
        }

        try {
            $user = User::create([
                'login'      => $data['login'],
                'password'   => Hash::make($data['password']),
                'image_path' => $avatar,
                'sex'        => $data['sex']
            ]);
        } catch (Exception $e) {
            return $e;
        }

        return $user;
    }


    public static function get($id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (Exception $e) {
            return $e;
        }

        return $user;
    }


    public static function login($data)
    {
        if (Auth::check()) {
            if (Auth::attempt(['login' => $data['login'], 'password' => $data['password']], $data['_token'])) {
                return Auth::user();
            } else {
                return false;
            }
        } else {
            return redirect('/');
        }

    }

}
