<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'user_id',
        'func_id'
    ];

    public function func()
    {
        return $this->belongsTo('App\Func');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
