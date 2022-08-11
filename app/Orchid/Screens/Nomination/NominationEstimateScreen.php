<?php

namespace App\Orchid\Screens\Nomination;

use App\Models\Criteria;
use App\Models\Event;
use App\Models\Nomination;
use App\Models\User;
use App\Models\UsersEvaluations;
use App\Orchid\Layouts\Nomination\NominationEstimatesTableLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class NominationEstimateScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Nomination $nomination): iterable
    {
        return [
            'nomination' => $nomination,
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
        return 'Оценка по номинации';
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
            Layout::columns(
                [
                    NominationEstimatesTableLayout::class,
                ]
            )
        ];
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
