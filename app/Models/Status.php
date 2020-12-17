<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{

    protected $table = 'statuses';
    public $timestamps = true;

    use SoftDeletes;

    public function orders()
    {
        return $this->belongsToMany('Order','status-changes')->withTimestamps();
    }

}
