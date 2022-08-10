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
            'events' => Event::where('isClosed', 0)->get(),
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
        return 'Get Started';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Welcome to your Orchid application.';
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
            Link::make('Рейтинг')
                ->href('http://#')
                ->class('bg-black text-white p-2 px-3 rounded')
                ->icon('trophy'),

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
