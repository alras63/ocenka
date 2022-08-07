<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Event;

use App\Models\Event;
use App\Models\EventNomination;
use App\Models\Nomination;
use App\Orchid\Layouts\Nomination\EventEditLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class EventEditScreen extends Screen
{
    /**
     * @var Event
     */
    public $event;

    /**
     * Query data.
     *
     * @param Event $event
     *
     * @return array
     */
    public function query(Event $event): iterable
    {
        $fullEvent = Event::with(Event::REL_EVENT_NOMINATIONS)
            ->where(Event::ATTR_ID, '=', $event->id)->first();
        return [
            'event' => $event,
            'event_nominations' => $fullEvent->event_nominations,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Управление событиями';
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Сохранить'))
                ->icon('check')
                ->method('save'),
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
            Layout::block([
                \App\Orchid\Layouts\Event\EventEditLayout::class,
            ])
                ->title('Мероприятие'),
             Layout::block([
                \App\Orchid\Layouts\Event\EventNominationsListLayout::class,
            ])
                ->title('Номинации')
        ];
    }

    /**
     * @param Request $request
     * @param Event $event
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request, Event $event)
    {
        $request->validate([
            'event.name' => [
                'required'
            ],
            'event.descriptions' => [
                'required'
            ],
            'event.selectedAsessor' => [
                'integer'
            ],
            'event.juriAssesment' => [
                'integer'
            ],
            'event.isSimpleEvent' => [
                'integer'
            ],
            'event.isClosed' => [
                'integer'
            ],
        ]);

        $event->fill($request->get('event'));

        $event->save();

        Toast::info(__('Мероприятие было сохранено'));

        return redirect()->route('platform.events');
    }

    /**
     * @param Event $event
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Event $event)
    {
        $event->delete();

        Toast::info(__('Мероприятие было удалено'));

        return redirect()->route('platform.events');
    }
}
