<?php

namespace App\Orchid\Layouts\Nomination;

use App\Models\Nomination;
use Orchid\Platform\Models\Role;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class NominationListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'nominations';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id', __('ID'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Nomination $nomination) {
                    return Link::make($nomination->id)
                        ->route('platform.nominations.edit', $nomination->id);
                }),

            TD::make('name', __('Name'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Nomination $nomination) {
                    return Link::make($nomination->name)
                        ->route('platform.nominations.edit', $nomination->id);
                }),

            TD::make('description', __('Description'))
                ->sort()
                ->filter(Input::make()),

            TD::make('short_name', __('Короткое название'))
                ->sort()
        ];
    }
}
