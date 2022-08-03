<?php

namespace App\Orchid\Screens\Event;

use App\Models\Event;
use App\Models\Nomination;
use App\Orchid\Layouts\Event\EventListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class EventListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'events' => Event::filters()->defaultSort('id', 'desc')->paginate(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список мероприятий в системе';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->href(route('platform.events.create')),
        ];
    }
    /**
     * Views.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            \App\Orchid\Layouts\Event\EventListLayout::class,
        ];
    }
}
