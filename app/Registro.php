<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $table = 'canales_registro';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'streams_sys_id', 'stream_id', 'fecha', 'estado', 'creado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function StreamSys()
    {
            return $this->belongsTo(StreamSys::class, 'streams_sys_id', 'server_stream_id');
    }
    public function Servidores()
    {
        return $this->hasMany(Registro::class, 'stream_id', 'stream_id');
    }
    public function Stream()
    {
        return $this->belongsTo(Stream::class);
    }
}
