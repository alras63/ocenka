<?php

namespace App\Orchid\Layouts\User;

use App\Models\Event;
use App\Models\EventNomination;
use App\Models\Nomination;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Listener;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Facades\Layout;

class UserNominationModalLayout extends Listener
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;
    protected $events;

    public function __construct()
    {
        $this->events = Event::all();
    }

    protected $targets = [
        'newEvent',
        'newNomination',
    ];

    /**
     * Get the fields elements to be displayed.
     *
     * @return Layout[]
     */

    protected $asyncMethod = 'asyncNominations';

    protected function layouts(): array
    {
        $valueOptions = [];
        if($this->query->get('newNomination')) {
            $this->query->get('newNomination')->each(function ($eventNomination) use(&$valueOptions) {
                $valueOptions[ $eventNomination->nomination->id] = $eventNomination->nomination->name;
            });
        }

        return [Layout::rows([
            Select::make('newEvent')
                ->fromModel(Event::class, 'name')
                ->title('Выберите конкурс')
                ->empty('Не выбрано'),
            Select::make('newNomination')
                ->multiple()
                ->options($valueOptions)
                ->title('Выберите номинации')
        ])];
    }
}
