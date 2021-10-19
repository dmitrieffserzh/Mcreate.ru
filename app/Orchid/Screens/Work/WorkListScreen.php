<?php

namespace App\Orchid\Screens\Work;

use App\Models\Work;
use App\Orchid\Layouts\Work\WorkListLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;

class WorkListScreen extends Screen {

	public $name = 'Страницы';

	public $description = 'Список всех страниц';

	public function query(): array {

		$result = Work::filters()->defaultSort('created_at', 'desc')->paginate( 15 );


		return [

			'works' => $result
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
			    ->href( route( 'platform.works.create' ) ),
		];
	}

	public function layout(): array {
		return [
			WorkListLayout::class,
		];
	}

	public function remove(Work $works)
	{
		$works->delete();

		Toast::info('Страница удалена');

		return redirect()->route('platform.works');
	}
}
