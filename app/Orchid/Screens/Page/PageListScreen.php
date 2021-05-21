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

	public function recursion( $page, $prefix ): array {
		$pageTree = [];
		foreach ( $page->child as $pageChild ):
			$pageTree[] = $this->getTree( $pageChild, '—' . $prefix );
			$pageTree   = array_merge( $pageTree, $this->recursion( $pageChild, '—' . $prefix ) );
		endforeach;

		return $pageTree;
	}

	public function query(): array {

		$pages = Page::where( 'parent_id', '=', 0 )->paginate( 15 );

		$pageTree = [];
		foreach ( $pages as $page ):
			if ( $page->parent_id == 0 ) :
				$pageTree[] = $page->title;
			endif;

			$pageTree = array_merge( $pageTree, $this->recursion( $page, "" ) );
		endforeach;

		dd( $pageTree );

		return [
			'pages' => $pageTree
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

	public function commandBar(): array {
		return [
			Link::make( __( 'Добавить страницу' ) )
			    ->icon( 'plus' )
			    ->href( route( 'platform.pages.create' ) ),
		];
	}

	public function layout(): array {
		return [
			PageListLayout::class,
		];
	}

	public function remove( Page $page ) {
		$page->delete();

		Toast::info( 'Страница удалена' );

		return redirect()->route( 'platform.pages' );
	}

	public function getTree( $page, $prefix ) {

		return $prefix . $page['title'];
	}

}
