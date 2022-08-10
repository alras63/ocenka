<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Nomination;

use App\Models\Role;
use App\Models\User;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;
use Symfony\Component\Console\Helper\Table;

class NominationEditLayout extends Rows
{
    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('nomination.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Название'))
                ->placeholder(__('Название')),

            Input::make('nomination.description')
                ->type('text')
                ->max(255)
                ->title(__('Описание'))
                ->placeholder(__('Описание')),

            Input::make('nomination.short_name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Короткое название'))
                ->placeholder(__('Короткое название')),
            Select::make('users.')
                ->fromModel(User::whereHas('roleUser', function($q){
                    $q->where('role_id', Role::where('name', 'Гражданин')->orWhere('name', 'Госслужащий')->first()->id);
                }), 'name')
                ->multiple()
                ->title('Назначенные участники')
        ];
    }

}
