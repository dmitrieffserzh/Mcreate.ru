<?php

namespace App\Orchid\Screens\Page;

use Orchid\Screen\Fields\Input;
use Orchid\Support\Color;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use App\Orchid\Layouts\Page\PageEditLayout;

class PageEditScreen extends Screen {
	/**
	 * Display header name.
	 *
	 * @var string
	 */
	public $name = 'Добавить страницу';

	/**
	 * Display header description.
	 *
	 * @var string|null
	 */
	public $description = '';

	/**
	 * Query data.
	 *
	 * @return array
	 */
	public function query(): array {
		return [];
	}

	/**
	 * Button commands.
	 *
	 * @return \Orchid\Screen\Action[]
	 */
	public function commandBar(): array {
		return [];
	}

	/**
	 * Views.
	 *
	 * @return \Orchid\Screen\Layout[]|string[]
	 */
	public function layout(): array {
		return [
			Layout::columns( [
				Layout::rows( [

					Input::make( 'title' )
					     ->title( 'Заголовок' )
					     ->placeholder( 'Введите заголовок страницы' )
					     ->required(),

					Input::make( 'slug' )
					     ->title( 'Введите "SLUG"' )
					     ->placeholder( '' )
					     ->help( "Допускоется введение символов a-z, 0-9 и _-" ),
				] ),
			] ),
		];
	}
}
