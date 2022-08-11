<?php

namespace App\Orchid\Layouts\Nomination;

use App\Models\Criteria;
use App\Models\Event;
use App\Models\Nomination;
use App\Models\User;
use App\Models\UsersEvaluations;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Builder;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Support\Color;

class NominationEstimatesTableLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'users';



    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('surname', __('Пользователь'))
                ->sort()
                ->cantHide(),
            TD::make('', __('Оценка за этап 1 (ИНДИГО)'))
                ->sort()
                ->cantHide()
                ->render(function (User $user) {
                    $criteriaOne = Criteria::where('nomination', '=', $this->query->get('nomination.id'))->where('step', '=', 1)->first();
                    $user_ev_one = UsersEvaluations::where('criterian', '=', $criteriaOne->id)->where('users', '=', $user->id)->first();

                    return Input::make("users[$user->id][indigoBall]")->value($user_ev_one?->result);
                }),
            TD::make('', __('Оценка за этап 2 (в программе Конкурсы)'))
                ->sort()
                ->cantHide(),
            TD::make('', __('Оценка за этап 3 (вне конкурса)'))
                ->sort()
                ->cantHide()
                ->render(function (User $user) {
                    $criteriaThree = Criteria::where('nomination', '=', $this->query->get('nomination.id'))->where('step', '=', 3)->first();
                    $user_ev_three = UsersEvaluations::where('criterian', '=', $criteriaThree->id)->where('users', '=', $user->id)->first();

                    return Input::make("users[$user->id][dopBall]")->value($user_ev_three?->result);
                }),
            TD::make('', __('Итог'))
                ->sort()
                ->cantHide(),

            TD::make('', __('Действие'))
                ->sort()
                ->cantHide()
                ->render(function () {
                        return  Button::make('Сохранить строку')->method('test')->type(Color::PRIMARY());
                    })


        ];
    }
}
