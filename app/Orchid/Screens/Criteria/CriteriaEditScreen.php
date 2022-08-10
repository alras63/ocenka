<?php

namespace App\Orchid\Screens\Criteria;


use App\Models\Criteria;
use App\Orchid\Layouts\Criteria\CriteriaEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class CriteriaEditScreen extends Screen
{

    /**
     * @var Criteria
     */
    public $criteria;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Criteria $criteria): iterable
    {
        return [
            'criteria' => $criteria
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Управление критериями';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
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
                ->canSee($this->criteria->exists),
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
            Layout::block([
                CriteriaEditLayout::class
            ])
            ->title('Критерий'),
        ];
    }

    public function save(Request $request, Criteria $criteria){

        $criteria->fill($request->get('criteria'));
        $criteria->save();

        Toast::info(__('Критерий успешно сохранён.'));

        return redirect()->route('platform.criterias');
    }
}


