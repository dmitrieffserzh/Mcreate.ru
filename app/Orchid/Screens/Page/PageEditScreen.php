<?php

namespace App\Orchid\Screens\Page;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\Page;
use App\Orchid\Layouts\SlugEditListener;
use App\Orchid\Layouts\Helpers\MetaLayout;
use App\Orchid\Layouts\Page\PageEditLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Color;
use Orchid\Screen\Fields\Group;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class PageEditScreen extends Screen {

	public $name = 'Редактировать';

	public $description = 'Редактирование страницы';

	public function query( Page $page ): array {

		if ( ! $page->exists ) {
			$this->name        = 'Добавить';
			$this->description = 'Добавление новой страницы';
		}

		$meta = [];
		foreach ( $page->meta as $item ):
			$meta = (array) $item->getAttributes();
		endforeach;

		return [
			'page'  => $page,
			'title' => $page->title,
			'meta'  => $meta
		];
	}

	public function commandBar(): array {
		return [
			Button::make( 'Отменить' )
			      ->method( 'cancel' )
			      ->type( Color::LIGHT() )
			      ->icon( 'close' ),
			Button::make( 'Сохранить' )
			      ->method( 'save' )
			      ->type( Color::LIGHT() )
			      ->icon( 'check' ),
		];
	}

	public function asyncSlugEdit( $title ) {

		$slug = Str::slug( $title, '-' );

		return [
			'page.slug'  => $slug,
			'page.title' => $title
		];
	}

	public function layout(): array {
		return [
			Layout::tabs( [
				'Контент' => [
					PageEditLayout::class,
				],
				'SEO'     => [
					MetaLayout::class,
					new SlugEditListener( 'page' )
				]
			] ),
			Layout::rows( [
				Group::make( [
					Button::make( 'Отменить' )
					      ->method( 'cancel' )
					      ->icon( 'close' )
					      ->class( 'float-start btn btn-' . Color::SECONDARY() ),
					Button::make( 'Сохранить' )
					      ->method( 'save' )
					      ->icon( 'check' )
					      ->class( 'float-end btn btn-' . Color::PRIMARY() ),
				] )
			] )
		];
	}

	public function save( Page $page, Request $request ) {
		$request->validate( [
			'page.title' => [
				'required',
				Rule::unique( Page::class, 'title' )->ignore( $page ),
			],
			'page.slug'  => [
				'required',
				'regex:/[a-zA-Z0-9-]/',
				Rule::unique( Page::class, 'slug' )->ignore( $page ),
			],
		] );

		$pageData = $request->get( 'page' );
		$metaData = $request->get( 'meta' );

		$page->fill( $pageData );
		$page->save();
		if ( count( $page->meta ) > 0 ):
			$page->meta()->update( $metaData );
		else:
			$page->meta()->create( $metaData );
		endif;
		$page->save();

		Toast::info( 'Страница сохранена!' );

		return redirect()->route( 'platform.pages' );
	}


	public function remove( Page $page ) {
		$page->delete();
		$page->meta()->delete();
		Toast::info( 'Страница удалена' );

		return redirect()->route( 'platform.pages' );
	}

	public function cancel() {
		return redirect()->route( 'platform.pages' );
	}
}
