<?php

namespace App\Orchid\Screens\Page;

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

class PageEditScreen extends Screen {

	public $name = 'Редактировать';

	public $description = 'Редактирование страницы';

	private $page;

	public function query( Page $page ): array {
		$this->page = $page;

		if ( ! $page->exists ) {
			$this->name        = 'Добавить';
			$this->description = 'Добавление новой страницы';
		}

		return [
			'page'  => $page,
			'title' => $page->title
		];
	}

	public function commandBar(): array {
		return [
			Button::make( 'Отменить' )
			      ->method( 'buttonClickProcessing' )
			      ->type( Color::LIGHT() )
			      ->icon( 'close' ),
			Button::make( 'Сохранить' )
			      ->method( 'buttonClickProcessing' )
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
					SlugEditListener::class,
				]
			] ),
			Layout::rows( [
				Group::make( [
					Button::make( 'Отменить' )
					      ->method( 'buttonClickProcessing' )
					      ->icon( 'close' )
					      ->class( 'float-start btn btn-' . Color::SECONDARY() ),
					Button::make( 'Сохранить' )
					      ->method( 'buttonClickProcessing' )
					      ->icon( 'check' )
					      ->class( 'float-end btn btn-' . Color::PRIMARY() ),
				] )
			] )
		];
	}
}
