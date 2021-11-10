<?php

declare( strict_types=1 );

namespace App\Orchid\Layouts\Work;

use App\Models\Testimonial;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Relation;

class WorkEditLayout extends Rows {

	public $target = 'work';

	public function fields(): array {
		return [
			Group::make( [
				Input::make( 'title' )
				    ->title( 'Заголовок' )
				    ->placeholder( 'Введите заголовок страницы' )
				    ->style( 'width: 100%; max-width: 100%;' )
				    ->required(),
			] ),

			Group::make([
                Relation::make('work.testimonial_id')
                    ->empty('Не выбрано')
                    ->fromModel(Testimonial::class, 'title', 'id')

                    ->title('Привязать отзыв'),
				RadioButtons::make( 'works.published')
				     ->title( 'Активность' )
				    ->options([
				        1 => 'Опубликовать',
				        0 => 'Скрыть',
				    ])
				    ->value( 1 )
			]),

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

			Input::make( 'work.url' )
			    ->title( 'Ссылка на проект' )
			    ->placeholder( 'http://example.com' )
			    ->style( 'width: 100%; max-width: 100%;' )
                ->help('Необходимо вводить без "/" в конце строки')
                ->required(),

			Matrix::make( 'work.work' )
			    ->title( 'Что сделали' )
			    ->columns( [
			        'Описание',
			    ] )
			    ->fields( [
			        'Описание' => TextArea::make(),
			    ] ),

			Matrix::make( 'work.results' )
                ->title( 'Результаты' )
			    ->columns( [
			        'Цифра',
			        'Описание',
			    ] )
			    ->fields( [
			        'Цифра'    => Input::make()->type( 'number' ),
			        'Описание' => TextArea::make(),
			    ] ),
		];
	}
}
