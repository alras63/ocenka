<?php

namespace App\Orchid\Screens\User;

use App\Models\Event;
use App\Models\EventNomination;
use App\Models\Nomination;
use App\Models\UserEventNomination;
use App\Orchid\Layouts\User\UserNominationModalLayout;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\ModalToggle;
use \Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class UserProfileCardScreen extends Screen
{
    public $user;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(User $user): iterable
    {
        return [
            'user' => $user,
            'events' => Event::all(),
            'userEvents' => UserEventNomination::where('user', $user->id)->get(),
            'modalToggle' => function(){
            return ModalToggle::make('Назначить на конкурс')
                ->modal('userNominationModal')
                ->method('save')
                ->class('border rounded p-2 px-4');
            }
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Профиль пользователя';
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

    public function asyncNominations(int $newEvent)
    {
        return [
            'newEvent' => Event::where('id', '=', $newEvent)->get(),
            'newNomination' => EventNomination::whereHas('event', function($q) use ($newEvent) {
                $q->where('events', '=', $newEvent);
            })->get()
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::view('platform::partials.user-profile'),
            Layout::modal('userNominationModal', [
                UserNominationModalLayout::class,
            ])
            ->title('Назначить пользователя на конкурс')
            ->applyButton('Сохранить')
            ->closeButton('Закрыть'),
        ];
    }

    public function save(User $user, Request $request)
    {
        $newEvent = $request->get('newEvent');
        $newNominations = $request->get('newNominations');


        foreach($newNominations as $nominations){
            $userEventNomination = new UserEventNomination;
            $userEventNomination->fill(['user' => $user->id, 'event' => $newEvent, 'nomination' => $nominations]);
            $userEventNomination->save();
        }


        Toast::info(__('User was saved.'));

        return redirect()->route('platform.systems.users');
    }
}
