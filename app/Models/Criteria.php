<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Access\RoleAccess;
use Orchid\Filters\Filterable;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class Criteria extends Model
{
    use RoleAccess, Filterable, AsSource, Chartable, HasFactory;

    protected $table = 'criterias';

    protected $guarded = [];
}
