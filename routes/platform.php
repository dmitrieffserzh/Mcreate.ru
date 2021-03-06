<?php

declare(strict_types=1);


use App\Orchid\Screens\Page\PageListScreen;
use App\Orchid\Screens\Page\PageEditScreen;
use App\Orchid\Screens\Service\ServiceListScreen;
use App\Orchid\Screens\Service\ServiceEditScreen;
use App\Orchid\Screens\Work\WorkListScreen;
use App\Orchid\Screens\Work\WorkEditScreen;
use App\Orchid\Screens\Testimonial\TestimonialListScreen;
use App\Orchid\Screens\Testimonial\TestimonialEditScreen;
use App\Orchid\Screens\Request\RequestListScreen;
use App\Orchid\Screens\Request\RequestViewScreen;
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
use App\Orchid\Screens\Settings\SettingsEditScreen;
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
    ->name('platform.systems.users.edit');

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

// Platform > System > Roles > Role
Route::screen('roles/{roles}/edit', RoleEditScreen::class)
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

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Example screen'));
    });

Route::screen('example-fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('example-layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('example-charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('example-editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('example-cards', ExampleCardsScreen::class)->name('platform.example.cards');
Route::screen('example-advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');

//Route::screen('idea', 'Idea::class','platform.screens.idea');













// MY ROUTES
// =====================================================================================================================

// PAGES
// =====================================================================================================================

// Platform > Pages > Edit
Route::screen('pages/{id}/edit', PageEditScreen::class)
	->name('platform.pages.edit')
	->breadcrumbs(function (Trail $trail, $page) {
		return $trail
			->parent('platform.pages')
			->push(__('Edit'), route('platform.pages.edit', $page));
	});

// Platfotm > Pages > Create
Route::screen('pages/create', PageEditScreen::class)
     ->name('platform.pages.create')
     ->breadcrumbs(function (Trail $trail) {
	     return $trail
		     ->parent('platform.pages')
		     ->push(__('Create'), route('platform.pages.create'));
     });

// Platfotm > Pages
Route::screen('pages', PageListScreen::class)
	->name('platform.pages')
	->breadcrumbs(function (Trail $trail) {
		return $trail
			->parent('platform.index')
			->push(__('????????????????'), route('platform.pages'));
	});

// SERVICES
// =====================================================================================================================

// Platform > Services > Edit
Route::screen('services/{id}/edit', ServiceEditScreen::class)
     ->name('platform.services.edit')
     ->breadcrumbs(function (Trail $trail, $services) {
	     return $trail
		     ->parent('platform.works')
		     ->push(__('Edit'), route('platform.services.edit', $services));
     });

// Platfotm > Services > Create
Route::screen('services/create', ServiceEditScreen::class)
     ->name('platform.services.create')
     ->breadcrumbs(function (Trail $trail) {
	     return $trail
		     ->parent('platform.works')
		     ->push(__('Create'), route('platform.services.create'));
     });

// Platfotm > Services
Route::screen('services', ServiceListScreen::class)
     ->name('platform.services')
     ->breadcrumbs(function (Trail $trail) {
	     return $trail
		     ->parent('platform.index')
		     ->push(__('??????????????????'), route('platform.services'));
     });

// WORKS
// =====================================================================================================================

// Platform > Works > Edit
Route::screen('works/{id}/edit', WorkEditScreen::class)
     ->name('platform.works.edit')
     ->breadcrumbs(function (Trail $trail, $works) {
	     return $trail
		     ->parent('platform.works')
		     ->push(__('Edit'), route('platform.works.edit', $works));
     });

// Platfotm > Works > Create
Route::screen('works/create', WorkEditScreen::class)
     ->name('platform.works.create')
     ->breadcrumbs(function (Trail $trail) {
	     return $trail
		     ->parent('platform.works')
		     ->push(__('Create'), route('platform.works.create'));
     });

// Platfotm > Works
Route::screen('works', WorkListScreen::class)
     ->name('platform.works')
     ->breadcrumbs(function (Trail $trail) {
	     return $trail
		     ->parent('platform.index')
		     ->push(__('??????????????????'), route('platform.works'));
     });


// TESTIMONIALS
// =====================================================================================================================

// Platform > Testimonials > Edit
Route::screen('testimonials/{id}/edit', TestimonialEditScreen::class)
     ->name('platform.testimonials.edit')
     ->breadcrumbs(function (Trail $trail, $testimonials) {
	     return $trail
		     ->parent('platform.testimonials')
		     ->push(__('Edit'), route('platform.testimonials.edit', $testimonials));
     });

// Platfotm > Testimonials > Create
Route::screen('testimonials/create', TestimonialEditScreen::class)
     ->name('platform.testimonials.create')
     ->breadcrumbs(function (Trail $trail) {
	     return $trail
		     ->parent('platform.testimonials')
		     ->push(__('Create'), route('platform.testimonials.create'));
     });

// Platfotm > Testimonials
Route::screen('testimonials', TestimonialListScreen::class)
     ->name('platform.testimonials')
     ->breadcrumbs(function (Trail $trail) {
	     return $trail
		     ->parent('platform.index')
		     ->push(__('????????????'), route('platform.testimonials'));
     });

// CALLBACKS
// =====================================================================================================================
// Platfotm > Callbacks > View
Route::screen('requests/{id}/view', RequestViewScreen::class)
     ->name('platform.requests.view')
     ->breadcrumbs(function (Trail $trail, $request) {
	     return $trail
		     ->parent('platform.index')
		     ->push(__('???????????? ???? ???????????????? ????????????'), route('platform.requests.view', $request));
     });
// Platfotm > Callbacks
Route::screen('requests', RequestListScreen::class)
     ->name('platform.requests')
     ->breadcrumbs(function (Trail $trail) {
	     return $trail
		     ->parent('platform.index')
		     ->push(__('???????????????? ????????????'), route('platform.requests'));
     });

// SETTINGS
// =====================================================================================================================
// Platform > Settings
Route::screen('settings', SettingsEditScreen::class)
     ->name('platform.settings')
     ->breadcrumbs(function (Trail $trail) {
	     return $trail
		     ->parent('platform.index')
		     ->push(__('??????????????????'), route('platform.settings'));
     });