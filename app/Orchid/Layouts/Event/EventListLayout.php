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

class EventListLayout extends Table
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
            TD::make('id', __('ID'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Event $event) {
                    return Link::make($event->id)
                        ->route('platform.events.edit', $event->id);
                }),

            TD::make('name', __('Name'))
                ->sort()
                ->cantHide()
                ->width('150px')
                ->filter(Input::make())
                ->render(function (Event $event) {
                    return Link::make($event->name)
                        ->route('platform.events.edit', $event->id);
                }),

            TD::make('descriptions', __('Description'))
                ->sort()
                ->width('450px')
                ->filter(Input::make()),

            TD::make('selectedAsessor', __('Видят только закрепленные асессоры?'))
                ->sort()
                ->filter(Input::make()),

            TD::make('juriAssesment', __('Жюри - оценивают?'))
                ->sort()
                ->filter(Input::make()),

            TD::make('isSimpleEvent', __('Это - конкурс в кадровый резерв?'))
                ->sort()
                ->filter(Input::make()),

            TD::make('isClosed', __('Скрыть мероприятие (закрыть)'))
                ->sort()
                ->filter(Input::make()),

        ];
    }
}
