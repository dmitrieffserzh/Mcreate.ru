<?php

namespace App\Orchid\Screens\Service;

use App\Models\Service;
use App\Orchid\Layouts\Service\ServiceListLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;

class ServiceListScreen extends Screen {

	public $name = 'Услуги';

	public $description = 'Список всех услуг';

	public function query(): array {
		$services = Service::paginate( 15 );

		return [
			'services' => $services
		];
	}

	public function commandBar(): array {
		return [
			Link::make( __( 'Добавить услугу' ) )
			    ->icon( 'plus' )
			    ->href( route( 'platform.services.create' ) ),
		];
	}

	public function layout(): array {
		return [
			ServiceListLayout::class,
		];
	}

	public function remove( Service $service ) {
		$service->delete();
		Toast::info( 'Услуга удалена' );

		return redirect()->route( 'platform.services' );
	}
}
