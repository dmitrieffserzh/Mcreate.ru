<?php

namespace App\Orchid\Screens\Settings;

use App\Models\Testimonial;
use App\Orchid\Layouts\Settings\SettingsEditLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Color;
use Orchid\Screen\Fields\Group;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class SettingsEditScreen extends Screen {

	public $name = 'Редактировать';

	public $description = 'Редактирование записи';

	public function query( Testimonial $testimonial ): array {

		if ( ! $testimonial->exists ) {
			$this->name        = 'Настройки';
			$this->description = 'Основные настройки сайта';
		}

		$meta = [];
		foreach ( $testimonial->meta as $item ):
			$meta = (array) $item->getAttributes();
		endforeach;

		return [
			'testimonial' => $testimonial,
			'title'       => $testimonial->title,
			'meta'        => $meta
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

	public function layout(): array {
		return [
				SettingsEditLayout::class,
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

	public function save( Testimonial $testimonial, Request $request ) {
		$request->validate( [
			'testimonial.title' => [
				'required',
				Rule::unique( Testimonial::class, 'title' )->ignore( $testimonial ),
			],
			'testimonial.slug'  => [
				'required',
				'regex:/[a-zA-Z0-9-]/',
				Rule::unique( Testimonial::class, 'slug' )->ignore( $testimonial ),
			],
		] );

		$pageData = $request->get( 'testimonial' );
		$metaData = $request->get( 'meta' );

		$testimonial->fill( $pageData );
		$testimonial->save();
		if ( count( $testimonial->meta ) > 0 ):
			$testimonial->meta()->update( $metaData );
		else:
			$testimonial->meta()->create( $metaData );
		endif;
		$testimonial->save();

		Toast::info( 'Отзыв сохранен!' );

		return redirect()->route( 'platform.settings' );
	}


	public function cancel() {
		return redirect()->route( 'platform.settings' );
	}
}