<?php

declare(strict_types=1);


use App\Orchid\Screens\Page\PageListScreen;
use App\Orchid\Screens\Page\PageEditScreen;
use App\Orchid\Screens\Portfolio\PortfolioListScreen;
use App\Orchid\Screens\Portfolio\PortfolioEditScreen;
use App\Orchid\Screens\Testimonial\TestimonialListScreen;
use App\Orchid\Screens\Testimonial\TestimonialEditScreen;
use App\Orchid\Screens\Callback\CallbackListScreen;

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
			->push(__('Страницы'), route('platform.pages'));
	});


// PORTFOLIO
// =====================================================================================================================

// Platform > Portfolio > Edit
Route::screen('portfolio/{id}/edit', PortfolioEditScreen::class)
     ->name('platform.portfolio.edit')
     ->breadcrumbs(function (Trail $trail, $portfolio) {
	     return $trail
		     ->parent('platform.portfolio')
		     ->push(__('Edit'), route('platform.portfolio.edit', $portfolio));
     });

// Platfotm > Portfolio > Create
Route::screen('portfolio/create', PortfolioEditScreen::class)
     ->name('platform.portfolio.create')
     ->breadcrumbs(function (Trail $trail) {
	     return $trail
		     ->parent('platform.portfolio')
		     ->push(__('Create'), route('platform.portfolio.create'));
     });

// Platfotm > Portfolio
Route::screen('portfolio', PortfolioListScreen::class)
     ->name('platform.portfolio')
     ->breadcrumbs(function (Trail $trail) {
	     return $trail
		     ->parent('platform.index')
		     ->push(__('Портфолио'), route('platform.portfolio'));
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
		     ->push(__('Отзывы'), route('platform.testimonials'));
     });

// CALLBACKS
// =====================================================================================================================
// Platfotm > Callbacks
Route::screen('callbacks', CallbackListScreen::class)
     ->name('platform.callbacks')
     ->breadcrumbs(function (Trail $trail) {
	     return $trail
		     ->parent('platform.index')
		     ->push(__('Обратный звонок'), route('platform.callbacks'));
     });