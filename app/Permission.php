<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded = [];

    /**
     * Permission belongs to Roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roles()
    {
        // belongsTo(RelatedModel, foreignKey = roles_id, keyOnRelatedModel = id)
        return $this->belongsToMany(Role::class);
    }

    /**
     * Permission belongs to Users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        // belongsTo(RelatedModel, foreignKey = users_id, keyOnRelatedModel = id)
        return $this->belongsToMany(User::class);
    }
}
