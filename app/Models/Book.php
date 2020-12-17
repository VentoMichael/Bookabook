<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;


    protected $table = 'books';
    public $timestamps = true;


    protected $fillable = [
        'title',
        'picture',
        'author',
        'publishing_house',
        'isbn',
        'public_price',
        'proposed_price',
        'presentation',
        'stock',
        'orientation'
    ];

    public function getRouteKeyName()
    {
        return 'title';
    }
    public function scopeDraft($query)
    {
        return $query->where('is_draft', '=', '1');
    }
    public function scopeNoDraft($query)
    {
        return $query->where('is_draft', '=', '0');
    }
    public function academic_years()
    {
        return $this->belongsToMany('AcademicYear','Sales')->withPivot('price','public_price')->withTimestamps();
    }
    public function orders(){
        return $this->belongsToMany(Order::class,'reservations','book_id','order_id')
            ->withPivot('quantity')
            ->withTimestamps();
    }
    public function getCoverAttribute($value){
        return asset($value);
    }

}
