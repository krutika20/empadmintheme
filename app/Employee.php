<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $fillable = [
        'emp_name', 'salary','email','dept_id','image_name'
    ];

    public function department()
    {
        return $this->belongsTo('App\Department','dept_id');
    }
}
