<?php namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'votes';

    protected $guarded = ['id'];

    public function userVoted()
    {
        return $this->belongsTo('App\User', 'who_voted_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'whom_voted_id', 'id');
    }

    public static function add($data)
    {
        if (Auth::user()->id !== $data['to']) {

            $vote = Vote::where('who_voted_id', '=', Auth::user()->id)
                ->where('whom_voted_id', '=', $data['to'])
                ->first();

            if (is_null($vote)) {


                try {

                    $vote = Vote::create([
                        'who_voted_id' => Auth::user()->id,
                        'whom_voted_id' => $data['to'],
                        'mark' => $data['mark']
                    ]);

                } catch (Exception $e) {

                    return $e;

                }

                return $vote;
            } else {
                $vote->mark = $data['mark'];
                $vote->save();
            }
        }

    }

}
