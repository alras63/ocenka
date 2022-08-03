<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Access\RoleAccess;
use Orchid\Filters\Filterable;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class Event extends Model
{
    use RoleAccess, Filterable, AsSource, Chartable, HasFactory;

    /**
     * @var string
     */
    protected $table = 'events';

    protected $guarded = [];
}
