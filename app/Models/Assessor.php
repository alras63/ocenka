<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Access\RoleAccess;
use Orchid\Filters\Filterable;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class Assessor extends Model
{
    use RoleAccess, Filterable, AsSource, Chartable, HasFactory;

    protected $table = 'assesor_nomination';

    protected $guarded = [];

    public function event(){
        return $this->hasMany(Event::class);
    }
}
