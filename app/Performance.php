<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    //
    protected $fillable = [
        'emp_id', 'user_id','would_recommended','performance_description'
    ];

    public function employee()
    {
        return $this->belongsTo('App\Department','emp_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Department','user_id');
    }
}
