<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'votes';

    protected $guarded = ['id'];

    public function whoVoted()
    {
        return $this->belongsTo('App\User', 'who_voted_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'whom_voted_id', 'id');
    }

}
