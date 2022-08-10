<?php

namespace App\Orchid\Layouts\Nomination;

use App\Models\Event;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
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
                ->render(function () {
                    return Input::make('');
                }),
            TD::make('', __('Оценка за этап 2 (в программе Конкурсы)'))
                ->sort()
                ->cantHide(),
            TD::make('', __('Оценка за этап 3 (вне конкурса)'))
                ->sort()
                ->cantHide()
                ->render(function () {
                    return Input::make('');
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
