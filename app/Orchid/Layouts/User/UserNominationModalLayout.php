<?php

namespace App\Orchid\Layouts\User;

use App\Models\Event;
use App\Models\Nomination;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class UserNominationModalLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Select::make('newEvent')
                ->fromModel(Event::class, 'name')
                ->title('Выберите конкурс'),
            Select::make('newNominations')
                ->fromModel(Nomination::class, 'name')
                ->multiple()
                ->title('Выберите номинации')
        ];
    }
}
