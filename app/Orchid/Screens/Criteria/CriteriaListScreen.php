<?php

namespace App\Orchid\Screens\Criteria;

use App\Models\Criteria;
use App\Orchid\Layouts\Criteria\CriteriaListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class CriteriaListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'criterias' => Criteria::all()
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список критериев в системе';
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
                ->href(route('platform.criterias.create')),
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
            CriteriaListLayout::class,
        ];
    }
}
