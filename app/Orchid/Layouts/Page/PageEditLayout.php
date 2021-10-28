<?php

declare( strict_types=1 );

namespace App\Orchid\Layouts\Page;

use App\Models\Page;

use App\Models\Service;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Relation;

class PageEditLayout extends Rows {



	public function fields(): array {
		return [
			Group::make( [
				Input::make( 'title' )
					->title( 'Заголовок' )
					->placeholder( 'Введите заголовок страницы' )
					->style( 'width: 100%; max-width: 100%;' )
					->required(),
			] ),

			Group::make( [
				Select::make( 'page.parent_id' )
					->fromModel( Page::class, 'title', 'id' )
					->empty( 'Корневая', '0' )
					->title( 'Вложенность' ),
				RadioButtons::make( 'page.published' )
					->title( 'Активность' )
					->options( [
						1 => 'Опубликовать',
						0 => 'Скрыть',
					 ] )
					->value( 1 ),
			] ),

			Quill::make( 'page.content' )
			     ->title( '' )
			     ->popover( '' ),

		];
	}
}
