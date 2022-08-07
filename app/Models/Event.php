<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Access\RoleAccess;
use Orchid\Filters\Filterable;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class Event extends Model
{
    use RoleAccess, Filterable, AsSource, Chartable, HasFactory;

    const ATTR_ID        = 'id';

    /**
     * @var string
     */
    protected $table = 'events';

    protected $guarded = [];


    public function event_nominations(): HasMany {
        return $this->hasMany(EventNomination::class, EventNomination::ATTR_EVENTS, static::ATTR_ID);
    }
    const REL_EVENT_NOMINATIONS = 'event_nominations';
}
