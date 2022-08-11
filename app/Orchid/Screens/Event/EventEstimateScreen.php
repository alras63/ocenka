<?php

namespace App\Orchid\Screens\Event;

use App\Models\Event;
use App\Models\Nomination;
use App\Orchid\Layouts\Nomination\NominationEstimatesTableLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class EventEstimateScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Event $event): iterable
    {
        $fullEvent = Event::with(Event::REL_EVENT_NOMINATIONS)
            ->where(Event::ATTR_ID, '=', $event->id)->first();
        return [
            'event_nominations' => $fullEvent ? $fullEvent->event_nominations : [],
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Оценка по мероприятию';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            \App\Orchid\Layouts\Event\EventNominationsListLayout::class,
        ];
    }
}
