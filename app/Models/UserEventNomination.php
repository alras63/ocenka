<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Access\RoleAccess;
use Orchid\Filters\Filterable;
use Orchid\Metrics\Chartable;
use Orchid\Platform\Models\User as Authenticatable;
use Orchid\Screen\AsSource;

class UserEventNomination extends Model
{
    use RoleAccess, Filterable, AsSource, Chartable, HasFactory;
    const ATTR_USER        = 'user';
    const ATTR_NOMINATION  = 'nomination';
    /**
     * @var string
     */
    protected $table = 'user_event_nomination';

    protected $guarded = [];


}
