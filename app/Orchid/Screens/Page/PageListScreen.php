<?php

namespace App\Orchid\Screens\Page;

use App\Models\Page;
use App\Orchid\Layouts\Page\PageListLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;

class PageListScreen extends Screen {

	public $name = 'Страницы';

	public $description = 'Список всех страниц';

	public function query(): array {

		$pages = Page::with( 'parent' )->paginate( 15 );

		//dd( $pages );

//    	$gpages  = Page::where()->paginate();
//		$pages = [];
//	    foreach ($gpages as $page):
//		    array_push($pages,$page);
//	    endforeach;
//
//	    $basePage = array_filter($pages, function($obj){
//		    if($obj->parent_id == 0) {
//			    return true;
//		    }
//		    return false;
//	    });
//
//	    for ($i = 1; $i < count($basePage); $i++) {
//		    $basePage[$i]['subpage'] = $this->getSubparrent( $basePage[$i], $pages );
//
//	    }
//	    print_r($basePage);
		return [
			//'pages' => $basePage
			'pages' => $pages
			//->filters()
			//->filtersApplySelection(UserFiltersLayout::class)
			//->defaultSort('id', 'desc')
			//paginate(),
		];
	}

	/*public function getSubparrent( $basePage, $pagess ): array {
		$subPages = array_filter( $pagess, function ( $obj ) use ( $basePage ) {

			if ( $obj->parent_id == $basePage->id ) {
				return true;
			}

			return false;
		} );
		for ( $i = 1; $i < count( $subPages ); $i ++ ) {
			$subPages[ $i ]->subpage = $this->getSubparrent( $subPages[ $i ], $pagess );
		}

		return $subPages;
	}*/

	/**
	 * Button commands.
	 *
	 * @return \Orchid\Screen\Action[]
	 */
	public function commandBar(): array {
		return [
			Link::make( __( 'Добавить страницу' ) )
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
			PageListLayout::class,
		];
	}

	public function remove(Page $page)
	{
		$page->delete();

		Toast::info('Страница удалена');

		return redirect()->route('platform.pages');
	}
}
