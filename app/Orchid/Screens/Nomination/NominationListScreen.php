<?php

namespace App\Orchid\Screens\Nomination;

use App\Models\Nomination;
use App\Orchid\Layouts\Nomination\NominationEditLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class NominationListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'nominations' => Nomination::filters()->defaultSort('id', 'desc')->paginate(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список номинаций в системе';
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
                ->href(route('platform.nominations.create')),
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
            NominationEditLayout::class,
        ];
    }
}
