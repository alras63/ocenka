<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Access\RoleAccess;
use Orchid\Filters\Filterable;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class Nomination extends Model
{
    use RoleAccess, Filterable, AsSource, Chartable, HasFactory;
    const ATTR_ID        = 'id';
    /**
     * @var string
     */
    protected $table = 'nominations';

    protected $guarded = [];

    public function eventNomination(){
        return $this->hasMany(EventNomination::class, 'nominations');
    }

    const REL_EVENT_NOMINATION = 'eventNomination';
}
