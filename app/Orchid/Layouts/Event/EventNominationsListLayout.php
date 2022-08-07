<?php

namespace App\Orchid\Layouts\Event;

use App\Models\Event;
use App\Models\EventNomination;
use App\Models\Nomination;
use Orchid\Platform\Models\Role;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class EventNominationsListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'event_nominations';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', __('Name'))
                ->sort()
                ->cantHide()
                ->width('150px')
                ->filter(Input::make())
                ->render(function (EventNomination $event_nominations) {
                    return Link::make($event_nominations->nomination->name)
                        ->route('platform.nominations.edit', $event_nominations->nomination->id);
                }),

        ];
    }
}
