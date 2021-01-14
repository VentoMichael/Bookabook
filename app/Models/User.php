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

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
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
        return $query->where('id', '=', '1');
    }

    public function scopeStudent($query)
    {
        return $query->where('id', '!=', '1');
    }

    public function scopeStudentSuspended($query)
    {
        return $query->where('suspended', '!=', '0');
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function getIsAdministratorAttribute(): bool
    {
        return $this->roles->pluck('name')->contains('administrator');
    }
    public function getIsStudentAttribute(): bool
    {
        return $this->roles->pluck('name')->contains('student');
    }
    public function assignRole($role)
    {
        return $this->roles()->save($role);
    }
    public function getRouteKeyName()
    {
        return 'name';
    }
}
