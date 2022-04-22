<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $guarded = [];

    /**
     * Role belongs to Permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permissions()
    {
        // belongsTo(RelatedModel, foreignKey = permissions_id, keyOnRelatedModel = id)
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Role belongs to Users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Users()
    {
        // belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
        return $this->belongsToMany(User::class);
    }
}
