<?php

declare( strict_types=1 );

namespace App\Orchid\Screens;

use App\Orchid\Layouts\Examples\ChartBarExample;
use App\Orchid\Layouts\Examples\ChartLineExample;
use App\Orchid\Layouts\Examples\ChartPercentageExample;
use App\Orchid\Layouts\Examples\ChartPieExample;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class PlatformScreen extends Screen {

	public $name = 'Панель управления';

	public $description = 'Добро пожаловать в панель управления MCREATE.RU';

	public function query(): array {
		return [
			'charts' => [
				[
					'name'   => 'Some Data',
					'values' => [ 25, 40, 30, 35, 8, 52, 17 ],
					'labels' => [ '12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm' ],
				],
				[
					'name'   => 'Another Set',
					'values' => [ 25, 50, - 10, 15, 18, 32, 27 ],
					'labels' => [ '12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm' ],
				],
				[
					'name'   => 'Yet Another',
					'values' => [ 15, 20, - 3, - 15, 58, 12, - 17 ],
					'labels' => [ '12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm' ],
				],
				[
					'name'   => 'And Last',
					'values' => [ 10, 33, - 8, - 3, 70, 20, - 34 ],
					'labels' => [ '12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm' ],
				],
			],
		];
	}


	public function commandBar(): array {
		return [];
	}

	public function layout(): array {
		return [
			//Layout::columns( [
			//	ChartLineExample::class,
			//	ChartBarExample::class,
			//] ),

			//Layout::columns( [
			//	ChartPercentageExample::class,
			//	ChartPieExample::class,
			//] ),

				Layout::view( 'platform::partials.welcome' )
			];

	}
}
