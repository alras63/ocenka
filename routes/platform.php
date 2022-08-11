<?php

declare(strict_types=1);

use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Profile'), route('platform.profile'));
    });

// Platform > System > Users
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(function (Trail $trail, $user) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('User'), route('platform.systems.users.edit', $user));
    });

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('Create'), route('platform.systems.users.create'));
    });

// Platform > System > Users > User
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Users'), route('platform.systems.users'));
    });

Route::screen('users/{user}/profile', \App\Orchid\Screens\User\UserProfileCardScreen::class)
    ->name('platform.systems.users.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Users'), route('platform.systems.users'));
    });

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Role'), route('platform.systems.roles.edit', $role));
    });

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Create'), route('platform.systems.roles.create'));
    });

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Roles'), route('platform.systems.roles'));
    });

// Platform > Nominations
Route::screen('nominations', \App\Orchid\Screens\Nomination\NominationListScreen::class)
    ->name('platform.nominations');

// Platform > Nominations > Create
Route::screen('nominations/create', \App\Orchid\Screens\Nomination\NominationEditScreen::class)
    ->name('platform.nominations.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->push(__('Create'), route('platform.nominations.create'));
    });

// Platform > Nominations > Edit
Route::screen('nominations/{role}/edit', \App\Orchid\Screens\Nomination\NominationEditScreen::class)
    ->name('platform.nominations.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->push(__('Номинация'), route('platform.nominations.edit', $role));
    });

// Platform > Events
Route::screen('events', \App\Orchid\Screens\Event\EventListScreen::class)
    ->name('platform.events');

// Platform > Events > Create
Route::screen('events/create', \App\Orchid\Screens\Event\EventEditScreen::class)
    ->name('platform.events.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->push(__('Create'), route('platform.events.create'));
    });

// Platform > Events > Edit
Route::screen('events/{role}/edit', \App\Orchid\Screens\Event\EventEditScreen::class)
    ->name('platform.events.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->push(__('Мероприятие'), route('platform.events.edit', $role));
    });

// Platform > Criterias
Route::screen('criterias', \App\Orchid\Screens\Criteria\CriteriaListScreen::class)
    ->name('platform.criterias');

// Platform > Criterias > Create
Route::screen('criterias/create', \App\Orchid\Screens\Criteria\CriteriaEditScreen::class)
    ->name('platform.criterias.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->push(__('Create'), route('platform.criterias.create'));
    });

// Platform > Criterias > Edit
Route::screen('criterias/{role}/edit', \App\Orchid\Screens\Criteria\CriteriaEditScreen::class)
    ->name('platform.criterias.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->push(__('Критерии'), route('platform.criterias.edit', $role));
    });

Route::screen('rating', \App\Orchid\Screens\RatingScreen::class)
    ->name('platform.rating');
