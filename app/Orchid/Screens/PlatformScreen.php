<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use App\Models\Event;
use App\Models\User;
use App\Models\UserEventNomination;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class PlatformScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'activeEvents' => Event::where('isClosed', 0)->get(),
            'archiveEvents' => Event::where('isClosed', 1)->get(),
            'users' => UserEventNomination::all(),
            'counterUsers' => 0
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Таволга. Единая система';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Добро пожаловать в единую систему Таволги';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {

        return [
            Link::make('Cлужащих в системе: ' . count(User::all()))
                ->class('text-black cursor-default m-3 d-block'),

        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            Layout::view('platform::partials.active_events'),
        ];
    }
}
