<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StreamSys extends Model
{
    protected $table = 'streams_sys';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'server_stream_id', 'stream_id', 'server_id', 'stream_status', 'stream_started'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    public function Stream()
    {
        return $this->belongsTo(StreamSys::class, 'stream_id', 'id');
    }
}
