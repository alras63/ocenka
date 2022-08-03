<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Event;

use App\Models\Event;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\TD;

class EventEditLayout extends Rows
{
    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('event.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Название'))
                ->placeholder(__('Название')),

            TextArea::make('event.descriptions')
                ->required()
                ->title(__('Описание'))
                ->placeholder(__('Описание')),

            CheckBox::make('event.selectedAsessor')
                ->title("Видят только закрепленные асессоры?")
                ->sendTrueOrFalse(),

            CheckBox::make('event.juriAssesment')
                ->title("Жюри - оценивают?")
                ->sendTrueOrFalse(),

            CheckBox::make('event.isSimpleEvent')
                ->title("Это - конкурс в кадровый резерв?")
                ->sendTrueOrFalse(),

            CheckBox::make('event.isClosed')
                ->title("Скрыть мероприятие (закрыть)")
                ->sendTrueOrFalse(),
        ];
    }
}
