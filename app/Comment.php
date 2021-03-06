<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_post', 'content', 'id_author', 'upvotes', 'downvotes', 'time_stamp', 'id_parent',
    ];

    /**
     * The user this comment belongs to
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id_author');
    }

    /**
     * The post this comment belongs to
     */
    public function post()
    {
        return $this->belongsTo('App\Post', 'id_post');
    }

    /**
     * The comment this reply belongs to
     */
    public function parent()
    {
        return $this->belongsTo('App\Comment', 'id_parent');
    }

    /**
     * The replies this comment has.
     */
    public function replies()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Users who have voted on this comment 
     */
    public function votedUsers()
    {
        return $this->belongsToMany('App\User', 'comment_vote', 'id_comment', 'id_user')->withPivot([
            'vote_type',
        ]);
    }

    /**
     * The reports this comment has.
     */
    public function reports()
    {
        return $this->hasMany('App\Report');
    }

    public static function search($query){
        return DB::select(
            DB::raw("

                SELECT comment_id, ts_rank_cd(to_tsvector('portuguese', c_search.content), query) AS weight
                FROM (
                    SELECT comment.id AS comment_id, comment.content AS content
                        FROM comment
                        GROUP BY comment.id) c_search, to_tsquery('portuguese', :query) AS query
                WHERE (to_tsvector('portuguese', c_search.content)) @@ query 
                ORDER BY weight DESC;"),
            array('query' => $query)
        );
    }
}
