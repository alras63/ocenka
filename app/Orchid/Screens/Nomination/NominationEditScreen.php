<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Nomination;

use App\Models\Nomination;
use App\Orchid\Layouts\Nomination\NominationEditLayout;
use App\Orchid\Layouts\Nomination\NominationListLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class NominationEditScreen extends Screen
{
    /**
     * @var Nomination
     */
    public $nomination;

    /**
     * Query data.
     *
     * @param Nomination $nomination
     *
     * @return array
     */
    public function query(Nomination $nomination): iterable
    {
        return [
            'nomination' => $nomination,
            'title' => 'title',

        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Управление номинациями';
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Сохранить'))
                ->icon('check')
                ->method('save'),

            Button::make(__('Удалить'))
                ->icon('trash')
                ->method('remove')
                ->canSee($this->nomination->exists),
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
            Layout::block([
                NominationEditLayout::class,
            ])
                ->title('Номинация')
        ];
    }

    /**
     * @param Request $request
     * @param Nomination $nomination
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request, Nomination $nomination)
    {
        $request->validate([
            'nomination.name' => [
                'required'
            ],
            'nomination.description' => [
                'required'
            ],
            'nomination.short_name' => [
                'required'
            ],
        ]);

        $nomination->fill($request->get('nomination'));

        $nomination->save();

        Toast::info(__('Номинация была сохранена'));

        return redirect()->route('platform.nominations');
    }

    /**
     * @param Nomination $nomination
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Nomination $nomination)
    {
        $nomination->delete();

        Toast::info(__('Номинация была удалена'));

        return redirect()->route('platform.nominations');
    }
}
