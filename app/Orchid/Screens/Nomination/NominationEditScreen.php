<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Nomination;

use App\Models\Criteria;
use App\Models\Event;
use App\Models\EventNomination;
use App\Models\Nomination;
use App\Models\User;
use App\Models\UserEventNomination;
use App\Models\UsersEvaluations;
use App\Orchid\Layouts\Event\EventListLayout;
use App\Orchid\Layouts\Event\EventNominationsListLayout;
use App\Orchid\Layouts\Nomination\NominationEditLayout;
use App\Orchid\Layouts\Nomination\NominationEstimatesTableLayout;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layouts\Columns;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use function MongoDB\BSON\toJSON;

class NominationEditScreen extends Screen
{
    /**
     * @var Nomination
     */
    public $nomination;

    /**
     * Query data.
     *
     * @param Nomination $nomination
     *
     * @return array
     */
    public function query(Nomination $nomination): iterable
    {
        return [
            'nomination' => $nomination,
            'title' => 'title',
            'estimates' => Event::all(),
            'users' => User::with([User::REL_USERS_EVALUATIONS])->wherehas('user_event_nomination', function($q) use($nomination){
                $q->where('nomination', $nomination->id);
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
        return 'Управление номинациями';
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
                ->canSee($this->nomination->exists),
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
                NominationEditLayout::class,
            ])
                ->title('Номинация'),
            Layout::columns(
                [
                    NominationEstimatesTableLayout::class,
                ]
            )
        ];
    }

    /**
     * @param Request $request
     * @param Nomination $nomination
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request, Nomination $nomination)
    {
        $request->validate([
            'nomination.name' => [
                'required'
            ],
            'nomination.description' => [
                'required'
            ],
            'nomination.short_name' => [
                'required'
            ],
        ]);



        $nominatedUsers = $request->get('users');
        if($nominatedUsers != null){
            foreach ($nominatedUsers as $user){
                $userEventNomination = new UserEventNomination;
                $event = EventNomination::where('nominations', $nomination->id)->first();
                if(UserEventNomination::where('user', $user)->where('nomination', $nomination->id)->first() == null){
                    $userEventNomination->fill(['user' => $user, 'event' => $event->events,'nomination' => $nomination->id]);
                    $userEventNomination->save();
                }
            }
        }


        $bdNominatedUsers = User::wherehas('user_event_nomination', function($q) use($nomination){
            $q->where('nomination', $nomination->id);
        })->get();
        foreach($bdNominatedUsers as $user){
            $shouldDelete = true;
            foreach ($nominatedUsers as $u){
                if($user->id == $u){
                    $shouldDelete = false;
                }
            }
            if($shouldDelete){
                UserEventNomination::where('user', $user->id)->where('nomination', $nomination->id)->delete();
            }
        }

        $nomination->fill($request->get('nomination'));
        $nomination->save();

        Toast::info(__('Номинация была сохранена'));
        return redirect()->route('platform.nominations');
    }

    /**
     * @param Nomination $nomination
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Nomination $nomination)
    {
        $nomination->delete();

        Toast::info(__('Номинация была удалена'));

        return redirect()->route('platform.nominations');
    }

    public function test(Nomination $nomination, Request $request)
    {
        if($request->get('users') !== null) {
            foreach ($request->get('users') as $key => $user) {
                $criteriaOne = Criteria::where('nomination', '=', $nomination->id)->where('step', '=', 1)->first();
                $criteriaThree = Criteria::where('nomination', '=', $nomination->id)->where('step', '=', 3)->first();
                if(null === $criteriaOne) {
                    die("Нет созданного критерия под оценку");
                }

                if(null === $criteriaThree) {
                    die("Нет созданного критерия под оценку");
                }

                $user_ev_one = UsersEvaluations::where('criterian', '=', $criteriaOne->id)->where('users', '=', $key)->first();
                $user_ev_three = UsersEvaluations::where('criterian', '=', $criteriaThree->id)->where('users', '=', $key)->first();

                if(is_array($user) && $user['indigoBall']) {
                    if(null === $user_ev_one) {
                        $user_ev_one = new UsersEvaluations();
                        $user_ev_one->users = $key;
                        $user_ev_one->criterian = $criteriaOne->id;
                        $user_ev_one->asessor = Auth::id();
                    }
                    $user_ev_one->result = $user['indigoBall'];
                    $user_ev_one->save();
                }

                if(is_array($user) &&  $user['dopBall']) {
                    if (null === $user_ev_three) {
                        $user_ev_three            = new UsersEvaluations();
                        $user_ev_three->users     = $key;
                        $user_ev_three->criterian = $criteriaThree->id;
                        $user_ev_three->asessor   = Auth::id();
                    }
                    $user_ev_three->result = $user['dopBall'];

                    $user_ev_three->save();
                }
            }
        }
    }
}
