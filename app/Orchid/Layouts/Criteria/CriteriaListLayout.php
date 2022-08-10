<?php

namespace App\Orchid\Layouts\Criteria;

use App\Models\Criteria;
use App\Models\Event;
use App\Models\Nomination;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CriteriaListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'criterias';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', __('ID'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Criteria $criteria) {
                    return Link::make($criteria->id)
                        ->route('platform.criterias.edit', $criteria->id);
                }),
            TD::make('name', __('Name'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Criteria $criteria) {
                    return Link::make($criteria->name)
                        ->route('platform.criterias.edit', $criteria->id)
                        ->class('w-100');
                })
                ->width('400px'),
            TD::make('nomination', __('Номинация'))
                ->sort()
                ->filter(Input::make())
                ->width('400px')
                ->render(function (Criteria $criteria) {
                    return Nomination::where('id', $criteria->nomination)->first()->name;
                }),
            TD::make('step', __('Этап'))
                ->sort()
                ->filter(Input::make())
                ->alignCenter(),
            TD::make('pp', __('Подпункт этапа'))
                ->sort()
                ->width('300px')
                ->filter(Input::make()),
            TD::make('description', __('Описание'))
                ->sort()
                ->filter(Input::make())
            ->width('400px'),
        ];
    }
}
