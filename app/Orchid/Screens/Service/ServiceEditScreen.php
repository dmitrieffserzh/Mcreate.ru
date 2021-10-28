<?php

namespace App\Orchid\Screens\Service;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Orchid\Layouts\SlugEditListener;
use App\Orchid\Layouts\Helpers\MetaLayout;
use App\Orchid\Layouts\Service\ServiceEditLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Color;
use Orchid\Screen\Fields\Group;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class ServiceEditScreen extends Screen {

	public $name = 'Редактировать';

	public $description = 'Редактирование услуги';

	public function query( Service $service ): array {

		if ( ! $service->exists ) {
			$this->name        = 'Добавить';
			$this->description = 'Добавление новой услуги';
		}

		$meta = [];
		foreach ( $service->meta as $item ):
			$meta = (array) $item->getAttributes();
		endforeach;

		return [
			'service' => $service,
			'title'   => $service->title,
			'meta'    => $meta
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

	public function asyncSlugEdit( $title ) {

		$slug = Str::slug( $title, '-' );

		return [
			'service.slug'  => $slug,
			'service.title' => $title
		];
	}

	public function layout(): array {
		return [
			Layout::tabs( [
				'Контент' => [
					ServiceEditLayout::class,
				],
				'SEO'     => [
					MetaLayout::class,
					new SlugEditListener( 'service' )
				]
			] ),
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

	public function save( Service $service, Request $request ) {

		$request->validate( [
			'service.title' => [
				'required',
				Rule::unique( Service::class, 'title' )->ignore( $service ),
			],
			'service.slug'  => [
				'required',
				'regex:/[a-zA-Z0-9-]/',
				Rule::unique( Service::class, 'slug' )->ignore( $service ),
			],
		] );

		$pageData = $request->get( 'service' );
		$metaData = $request->get( 'meta' );

		$service->fill( $pageData );
		$service->save();
		if ( count( $service->meta ) > 0 ):
			$service->meta()->update( $metaData );
		else:
			$service->meta()->create( $metaData );
		endif;
		$service->save();

		Toast::info( 'Услуга сохранена!' );

		return redirect()->route( 'platform.services' );
	}


	public function remove( Service $service ) {
		$service->delete();
		$service->meta()->delete();
		Toast::info( 'Услуга удалена' );

		return redirect()->route( 'platform.services' );
	}

	public function cancel() {
		return redirect()->route( 'platform.services' );
	}
}
