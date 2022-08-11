<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Platform\Models\User as Authenticatable;

class User extends Authenticatable
{
    const ATTR_ID        = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'permissions',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions'          => 'array',
        'email_verified_at'    => 'datetime',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'name',
        'email',
        'permissions',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
    ];

    public function user_event_nomination(): HasMany {
        return $this->hasMany(UserEventNomination::class, UserEventNomination::ATTR_USER, static::ATTR_ID);
    }
    const REL_USER_EVENT_NOMINATION = 'user_event_nomination';

    public function users_evaluations(): HasMany {
        return $this->hasMany(UsersEvaluations::class, 'users', static::ATTR_ID);
    }
    const REL_USERS_EVALUATIONS = 'users_evaluations';


    public function assessor(){
        return $this->hasMany(Assessor::class, 'asessor');
    }

    public function roleUser(){
        return $this->hasMany(RoleUser::class, 'user_id');
    }
}
