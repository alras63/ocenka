<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Access\RoleAccess;
use Orchid\Filters\Filterable;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class EventNomination extends Model
{
    use RoleAccess, Filterable, AsSource, Chartable, HasFactory;

    const ATTR_ID        = 'id';
    const ATTR_NOMINATIONS        = 'nominations';
    const ATTR_EVENTS       = 'events';

    /**
     * @var string
     */
    protected $table = 'events_nominations';

    protected $guarded = [];

    public function event(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Event::class, Event::ATTR_ID, static::ATTR_EVENTS);
    }
    public function nomination(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Nomination::class, Nomination::ATTR_ID, static::ATTR_NOMINATIONS);
    }
    const REL_EVENT = 'event';
    const REL_NOMINATION = 'nomination';

}
