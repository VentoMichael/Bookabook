<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    public $timestamps = true;

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'file_name',
        'email',
        'group',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function scopeAdmin($query)
    {
        return $query->where('name', '=', 'Vento');
    }

    public function scopeStudent($query)
    {
        return $query->where('name', '!=', 'Vento');
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function getIsAdministratorAttribute(): bool
    {
        return $this->roles->pluck('name')->contains('administrator');
    }

    public function getFirstLetterOfNameAttribute(){
        return strtoupper(substr($this->name,0,1));
    }

    public function getIsStudentAttribute(): bool
    {
        return $this->roles->pluck('name')->contains('student');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
