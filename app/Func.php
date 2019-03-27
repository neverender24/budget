<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Func extends Model
{
    protected $table = 'func';

    protected $primaryKey = 'recid';

    public function permissions()
    {
        return $this->hasMany('App\Permission');
    }
}
