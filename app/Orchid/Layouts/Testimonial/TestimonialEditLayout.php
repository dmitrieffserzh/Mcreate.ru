<?php

declare( strict_types=1 );

namespace App\Orchid\Layouts\Testimonial;

use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Layouts\Rows;

class TestimonialEditLayout extends Rows {

	public $target = 'testimonial';

	public function fields(): array {
		return [
			Group::make( [
				Input::make( 'title' )
				     ->title( 'Заголовок' )
				     ->placeholder( 'Введите заголовок страницы' )
				     ->style( 'width: 100%; max-width: 100%;' )
				     ->required(),
			] ),
			RadioButtons::make( 'testimonial.published' )
			            ->title( 'Активность' )
			            ->options( [
				            1 => 'Опубликовать',
				            0 => 'Скрыть',
			            ] )
			            ->value( 1 ),
			Cropper::make( 'testimonial.img_cover' )
			       ->title( 'Обложка' )
			       ->class( 'float-left' )
			       ->width( 1200 )
			       ->height( 496 )
			       ->targetRelativeUrl(),
			Quill::make( 'testimonial.content' )
			     ->title( '' )
			     ->popover( '' )
			     ->required(),
		];
	}
}
