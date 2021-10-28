<?php

declare( strict_types=1 );

namespace App\Orchid\Layouts\Service;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Layouts\Rows;

class ServiceEditLayout extends Rows {

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
				RadioButtons::make( 'service.published' )
				            ->title( 'Активность' )
				            ->options( [
					            1 => 'Опубликовать',
					            0 => 'Скрыть',
				            ] )
				            ->value( 1 ),
			] ),

			Quill::make( 'service.content' )
			     ->title( '' )
			     ->popover( '' ),

		];
	}
}
