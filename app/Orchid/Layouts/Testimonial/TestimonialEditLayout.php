<?php

declare( strict_types=1 );

namespace App\Orchid\Layouts\Testimonial;

use App\Models\Testimonial;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Fields\Picture;
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

			Group::make( [
				/*Select::make( 'testimonial.' )
				      ->fromModel( Testimonial::class, 'title', 'id' )
				      ->empty( 'Не выбран', '0' )
				      ->title( 'Связанный отзыв' ),*/
				RadioButtons::make( 'testimonial.published' )
				            ->title( 'Активность' )
				            ->options( [
					            1 => 'Опубликовать',
					            0 => 'Скрыть',
				            ] )
				            ->value( 1 )
			] ),
			Cropper::make('testimonial.img_cover')
			       ->title('Обложка')
			       ->class('float-left')
			       ->width(1200)
			       ->height(550)
			       ->targetRelativeUrl(),
			Quill::make( 'testimonial.content' )
			     ->title( '' )
			     ->popover( '' ),
		];
	}
}
