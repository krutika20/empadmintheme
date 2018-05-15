<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $fillable = [
        'dept_name'
    ];

    public function employess()
    {
        return $this->hasMany('App\Employee');
    }
}
