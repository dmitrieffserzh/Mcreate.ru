<?php

namespace App\Orchid\Screens\Work;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\Work;
use App\Orchid\Layouts\SlugEditListener;
use App\Orchid\Layouts\Helpers\MetaLayout;
use App\Orchid\Layouts\Work\WorkEditLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Color;
use Orchid\Screen\Fields\Group;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class WorkEditScreen extends Screen {

	public $name = 'Редактировать';

	public $description = 'Редактирование записи';

	public function query( Work $works ): array {

		if ( ! $works->exists ) {
			$this->name        = 'Добавить';
			$this->description = 'Добавление новой записи';
		}

		$meta = [];
		foreach ( $works->meta as $item ):
			$meta = (array) $item->getAttributes();
		endforeach;

		return [
			'work'  => $works,
			'title' => $works->title,
			'meta'  => $meta
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
			'work.slug'  => $slug,
			'work.title' => $title
		];
	}

	public function layout(): array {
		return [
			Layout::tabs( [
				'Контент' => [
					WorkEditLayout::class,
				],
				'SEO'     => [
					MetaLayout::class,
					new SlugEditListener( 'work' ),
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

	public function save( Work $work, Request $request ) {
		$request->validate( [
			'work.title' => [
				'required',
				Rule::unique( Work::class, 'title' )->ignore( $work ),
			],
			'work.slug'  => [
				'required',
				'regex:/[a-zA-Z0-9-]/',
				Rule::unique( Work::class, 'slug' )->ignore( $work ),
			],
		] );

		$pageData = $request->get( 'work' );
		$metaData = $request->get( 'meta' );

		$work->fill( $pageData );
		$work->save();
		if ( count( $work->meta ) > 0 ):
			$work->meta()->update( $metaData );
		else:
			$work->meta()->create( $metaData );
		endif;
		$work->save();

		Toast::info( 'Страница сохранена!' );

		return redirect()->route( 'platform.works' );
	}

	public function remove( Work $works ) {
		$works->delete();

		Toast::info( 'Страница удалена' );

		return redirect()->route( 'platform.works' );
	}

	public function cancel() {
		return redirect()->route( 'platform.works' );
	}
}
