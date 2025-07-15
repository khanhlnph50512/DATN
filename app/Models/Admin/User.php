<?php

namespace App\Models\Admin;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Admin\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'seri_user',
        'name',
        'email',
        'password',
        'avatar',
        'phone',
        'gender',
        'birthday',
        'address',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function roles()
{
    return $this->belongsToMany(Role::class, 'role_user');
}

// Kiểm tra người dùng có vai trò cụ thể không
public function hasRole($roleName)
{
    return $this->roles->contains('name', $roleName);
}

}
