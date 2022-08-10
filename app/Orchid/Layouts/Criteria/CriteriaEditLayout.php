<?php

namespace App\Orchid\Layouts\Criteria;

use App\Models\Nomination;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class CriteriaEditLayout extends Rows
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
            TextArea::make('criteria.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Название'))
                ->placeholder(__('Название')),
            TextArea::make('criteria.description')
                ->required()
                ->title(__('Описание'))
                ->placeholder(__('Описание')),
            Select::make('criteria.nomination')
                ->fromModel(Nomination::class, 'name')
                ->required()
                ->title(__('Номинация')),
            Input::make('criteria.step')
                ->type('number')
                ->max(255)
                ->required()
                ->title(__('Этап'))
                ->placeholder(__('Этап')),
            Input::make('criteria.pp')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Подпункт этапа'))
                ->placeholder(__('Подпункт этапа')),
            Input::make('criteria.minScore')
                ->type('number')
                ->max(255)
                ->required()
                ->title(__('Минимальный балл'))
                ->placeholder(__('Минимальный балл')),
            Input::make('criteria.maxScore')
                ->type('number')
                ->max(255)
                ->required()
                ->title(__('Максимальный балл'))
                ->placeholder(__('Максимальный балл')),
            Input::make('criteria.rangeScore')
                ->type('number')
                ->max(255)
                ->required()
                ->title(__('Шаг оценки'))
                ->placeholder(__('Шаг оценки')),
        ];
    }
}
