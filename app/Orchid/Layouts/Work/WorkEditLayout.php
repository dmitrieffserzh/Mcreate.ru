<?php

declare( strict_types=1 );

namespace App\Orchid\Layouts\Work;

use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Layouts\Rows;

class WorkEditLayout extends Rows {

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
				RadioButtons::make( 'work.published' )
				            ->title( 'Активность' )
				            ->options( [
					            1 => 'Опубликовать',
					            0 => 'Скрыть',
				            ] )
				            ->value( 1 )
			] ),
			Cropper::make( 'work.img_cover' )
			       ->title( 'Превью' )
			       ->class( 'float-left' )
			       ->width( 1200 )
			       ->height( 496 )
			       ->targetRelativeUrl(),
			Cropper::make( 'work.img_main' )
			       ->title( 'Обложка страницы' )
			       ->class( 'float-left' )
			       ->width( 1920 )
			       ->height( 1000 )
			       ->targetRelativeUrl(),
			Quill::make( 'work.content' )
			     ->title( '' )
			     ->popover( '' )
			     ->required(),
		];
	}
}
