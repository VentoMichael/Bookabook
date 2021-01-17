<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    protected $table = 'orders';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function academic_year()
    {
        return $this->belongsTo('AcademicYear','id','academic_year_id');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'reservations')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function statuses()
    {
        return $this->belongsToMany(Status::class, 'status-changes')->withTimestamps();
    }
    public function scopeDraft($query)
    {
        return $query->where('is_draft', '=', '1');
    }
    public function scopeNoDraft($query)
    {
        return $query->where('is_draft', '=', '0');
    }
}
