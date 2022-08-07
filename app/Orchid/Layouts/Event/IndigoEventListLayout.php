<?php

namespace App\Orchid\Layouts\Event;

use App\Models\Event;
use App\Models\Nomination;
use Orchid\Platform\Models\Role;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class IndigoEventListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'events';

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
                ->render(function (Event $event) {
                    return Link::make($event->name)
                        ->route('platform.events.indigo', $event->id);
                }),
        ];
    }
}
