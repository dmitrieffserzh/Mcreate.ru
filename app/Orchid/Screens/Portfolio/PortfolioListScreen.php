<?php

namespace App\Orchid\Screens\Portfolio;

use App\Models\Portfolio;
use App\Orchid\Layouts\Portfolio\PortfolioListLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;

class PortfolioListScreen extends Screen {

	public $name = 'Страницы';

	public $description = 'Список всех страниц';

	public function query(): array {

		$result = Portfolio::filters()->defaultSort('created_at', 'desc')->paginate( 15 );


		return [

			'portfolio' => $result
			//->filters()
			//->filtersApplySelection(UserFiltersLayout::class)
			//->defaultSort('id', 'desc')
			//paginate(),
		];
	}

	public function commandBar(): array {
		return [
			Link::make( __( 'Добавить запись' ) )
			    ->icon( 'plus' )
			    ->href( route( 'platform.portfolio.create' ) ),
		];
	}

	public function layout(): array {
		return [
			PortfolioListLayout::class,
		];
	}

	public function remove(Portfolio $portfolio)
	{
		$portfolio->delete();

		Toast::info('Страница удалена');

		return redirect()->route('platform.portfolio');
	}
}
