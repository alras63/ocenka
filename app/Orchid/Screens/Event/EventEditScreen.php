<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Event;

use App\Models\Asessor;
use App\Models\Assessor;
use App\Models\Event;
use App\Models\Nomination;
use App\Models\User;
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

        return [
            'event' => $event,
            'assessor' => User::whereHas('assessor', function($query) use($event){
                $query->where('event', $event->id);
            })->get(),
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

            Button::make(__('Удалить'))
                ->icon('trash')
                ->method('remove')
                ->canSee($this->event->exists),
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
                ->title('Мероприятие')
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
            'assessor.' => [
                'array'
            ]
        ]);

        $event->fill($request->get('event'));
        $event->save();

        $assessors = $request->get('assessor');

        for($i = 0; $i < count($assessors); $i++){
            $assessor = new Assessor;
            $user = User::where('id', $assessors[$i])->first();
            $currentEvent = Event::where('name', $event['name'])->first();
            $assessor->fill(['asessor' => $user->id, 'event'=>$currentEvent->id]);
            $assessor->save();
        }

        //Toast::info(__('Мероприятие было сохранено'));

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
