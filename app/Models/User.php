<?php

namespace App\Models;

use App\Models\Messages\Pattern;
use App\Models\Roles\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
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

    /**
     * @var string
     */
    protected $table = 'users';

    public function setPasswordAttribute(string $password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->attributes['role_id'] === Role::ADMIN;
    }

    /**
     * @return bool
     */
    public function isOperator(): bool
    {
        return $this->attributes['role_id'] === Role::OPERATOR;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function patterns()
    {
        return $this->hasMany(Pattern::class);
    }
}
