<?php namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    protected $guarded = ['id'];

    //protected $with = ['user'];

    public function userLeft()
    {
        return $this->belongsTo('App\User', 'who_left_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','whom_left_id', 'id');
    }

    public static function add($data)
    {
        try {

            $comment = Comment::create([
                'whom_left_id' => $data['id'],
                'who_left_id'  => $data['who_left'],
                'comment_text' => $data['comment_text']
            ]);

        } catch(Exception $e) {

            return $e;

        }

        return $comment;
    }

}
