<?php

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class PlatformProvider extends OrchidServiceProvider {

	public function boot( Dashboard $dashboard ): void {
		parent::boot( $dashboard );

		// ...
	}

	public function registerMainMenu(): array {
		return [
			Menu::make( 'Главная' )
			    ->icon( 'home' )
			    ->route( 'platform.main' ),

			// Контент
			Menu::make( 'Страницы' )
			    ->icon( 'layers' )
			    ->route( 'platform.pages' )
			    ->title( 'Контент' ),
			Menu::make( 'Услуги' )
			    ->icon( 'money' )
			    ->route( 'platform.services' ),
			Menu::make( 'Портфолио' )
			    ->icon( 'grid' )
				->route( 'platform.works' ),
			Menu::make( 'Отзывы' )
			    ->icon( 'bubble' )
				->route( 'platform.testimonials' ),
			Menu::make( 'Блог (DEV)' )
			    ->icon( 'module' )
			    ->list( [
				    Menu::make( 'Записи' )->icon( 'docs' ),
				    Menu::make( 'Категории' )->icon( 'folder' ),
				    Menu::make( 'Добавить запись' )->icon( 'note' ),
			    ] ),

			// Заявки
			Menu::make( 'Запросы' )
			    ->icon( 'call-in' )
				->route( 'platform.requests' )
			    ->title( 'Заявки' )
			    ->divider(),
			Menu::make( __( 'Users' ) )
			    ->icon( 'user' )
			    ->route( 'platform.systems.users' )
			    ->permission( 'platform.systems.users' )
			    ->title( __( 'Права и пользователи' ) ),

			Menu::make( __( 'Roles' ) )
			    ->icon( 'lock' )
			    ->route( 'platform.systems.roles' )
			    ->permission( 'platform.systems.roles' ),
			Menu::make( 'Настройки' )
			    ->icon( 'settings' )
			    ->route( 'platform.settings' )
			    ->title( 'Настройки продукта' ),




						Menu::make('Example screen')
							->icon('monitor')
							->route('platform.example')
							->title('Navigation')
							->badge(function () {
								return 6;
							}),

						Menu::make('Dropdown menu')
							->icon('code')
							->list([
								Menu::make('Sub element item 1')->icon('bag'),
								Menu::make('Sub element item 2')->icon('heart'),
							]),

						Menu::make('Basic Elements')
							->title('Form controls')
							->icon('note')
							->route('platform.example.fields'),

						Menu::make('Advanced Elements')
							->icon('briefcase')
							->route('platform.example.advanced'),

						Menu::make('Text Editors')
							->icon('list')
							->route('platform.example.editors'),

						Menu::make('Overview layouts')
							->title('Layouts')
							->icon('layers')
							->route('platform.example.layouts'),

						Menu::make('Chart tools')
							->icon('bar-chart')
							->route('platform.example.charts'),

						Menu::make('Cards')
							->icon('grid')
							->route('platform.example.cards')
							->divider(),



		];
	}

	public function registerProfileMenu(): array {
		return [
			Menu::make( 'Profile' )
			    ->route( 'platform.profile' )
			    ->icon( 'user' ),
		];
	}

	public function registerPermissions(): array {
		return [
			ItemPermission::group( __( 'System' ) )
			              ->addPermission( 'platform.systems.roles', __( 'Roles' ) )
			              ->addPermission( 'platform.systems.users', __( 'Users' ) ),
		];
	}

	public function registerSearchModels(): array {
		return [
			// ...Models
			// \App\Models\User::class
		];
	}
}
