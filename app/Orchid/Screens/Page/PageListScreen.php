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

		$pages = Page::where( 'parent_id', '=', 0 )->paginate( 15 );

		$pageTree = [];
		foreach ( $pages as $page ):
			if ( $page->parent_id == 0 ) :
				$pageTree[] = [
					'id'        => $page->id,
					'title'     => $page->title,
					'published' => $page->published,
					'slug'      => $page->slug,
					'content'   => $page->content
				];
			endif;

			$pageTree = array_merge( $pageTree, $this->recursion( $page, "" ) );
		endforeach;

		return [
			'pages' => $pageTree
		];
	}

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

	public function recursion( $page, $prefix ): array {
		$pageTree = [];
		foreach ( $page->child as $pageChild ):
			$pageTree[] = [
				'id'        => $page->id,
				'title'     => $this->getTree( $pageChild, '—' . $prefix ),
				'published' => $pageChild->published,
				'slug'      => $pageChild->slug,
				'content'   => $pageChild->content
			];
			$pageTree   = array_merge( $pageTree, $this->recursion( $pageChild, '—' . ' ' . $prefix ) );
		endforeach;

		return $pageTree;
	}

	public function getTree( $page, $prefix ) {

		return $prefix . ' ' . $page['title'];
	}

}
