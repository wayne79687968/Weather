<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
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
     * User belongs to Permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permissions()
    {
        // belongsTo(RelatedModel, foreignKey = permissions_id, keyOnRelatedModel = id)
        return $this->belongsToMany(Permission::class);
    }

    /**
     * User belongs to Roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roles()
    {
        // belongsTo(RelatedModel, foreignKey = roles_id, keyOnRelatedModel = id)
        return $this->belongsToMany(Role::class);
    }

    public function isRole($role_name)
    {
        foreach ($this->roles as $role) {
            if (Str::lower($role_name) == Str::lower($role->name)) {
                return true;
            }
        }
        return false;
    }
}
