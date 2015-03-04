<?php namespace App;

use Exception;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract {

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
	protected $fillable = ['login', 'password']; //TODO: replace here

    //protected $guarded = ['id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    protected $with = ['votes'];

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

    public static function getAllOrder()
    {
        $users = User::with(['votes' => function($query) {
            $query->orderByRaw('sum(mark)');
        }])->get();
        return $users;
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

    public static function add($data)
    {
        try {
            $user = User::create([
                'login'      => $data['title'],
                'password'   => $data['password'],
                'image_path' => $data['image_path'],
                'sex'        => $data['sex']
            ]);
        } catch(Exception $e) {
            return $e;
        }

        return $user;
    }

}
