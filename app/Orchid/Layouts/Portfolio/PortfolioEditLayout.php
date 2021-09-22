<?php

declare( strict_types=1 );

namespace App\Orchid\Layouts\Portfolio;

use App\Models\Testimonial;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class PortfolioEditLayout extends Rows {

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
				Select::make( 'portfolio.' )
				      ->fromModel( Testimonial::class, 'title', 'id' )
				      ->empty( 'Не выбран', '0' )
				      ->title( 'Связанный отзыв' ),
				RadioButtons::make( 'portfolio.published' )
				            ->title( 'Активность' )
				            ->options( [
					            1 => 'Опубликовать',
					            0 => 'Скрыть',
				            ] )
				            ->value( 1 )
			] ),
			Cropper::make( 'testimonial.img_cover' )
			       ->title( 'Обложка' )
			       ->class( 'float-left' )
			       ->width( 1200 )
			       ->height( 496 )
			       ->targetRelativeUrl(),
			Quill::make( 'portfolio.content' )
			     ->title( '' )
			     ->popover( '' ),

		];
	}
}
