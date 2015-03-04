<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    protected $guarded = ['id'];

    public function userLeft()
    {
        return $this->belongsTo('App\User', 'who_left_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','whom_left_id', 'id');
    }

}
