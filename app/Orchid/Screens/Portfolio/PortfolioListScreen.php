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

		$result = Portfolio::paginate( 15 );


		return [

			'portfolio' => $result
			//->filters()
			//->filtersApplySelection(UserFiltersLayout::class)
			//->defaultSort('id', 'desc')
			//paginate(),
		];
	}

	/**
	 * Button commands.
	 *
	 * @return \Orchid\Screen\Action[]
	 */
	public function commandBar(): array {
		return [
			Link::make( __( 'Добавить запись' ) )
			    ->icon( 'plus' )
			    ->href( route( 'platform.pages.create' ) ),
		];
	}

	/**
	 * Views.
	 *
	 * @return \Orchid\Screen\Layout[]|string[]
	 */
	public function layout(): array {
		return [
			PortfolioListLayout::class,
		];
	}

	public function remove(Portfolio $page)
	{
		$page->delete();

		Toast::info('Страница удалена');

		return redirect()->route('platform.pages');
	}
}
