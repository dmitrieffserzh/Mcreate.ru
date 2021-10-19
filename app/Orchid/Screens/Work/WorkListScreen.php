<?php

namespace App\Orchid\Screens\Work;

use App\Models\Works;
use App\Orchid\Layouts\Work\WorkListLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;

class WorkListScreen extends Screen {

	public $name = 'Страницы';

	public $description = 'Список всех страниц';

	public function query(): array {

		$result = Works::filters()->defaultSort('created_at', 'desc')->paginate( 15 );


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
			WorkListLayout::class,
		];
	}

	public function remove(Works $portfolio)
	{
		$portfolio->delete();

		Toast::info('Страница удалена');

		return redirect()->route('platform.portfolio');
	}
}
