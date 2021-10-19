<?php

namespace App\Orchid\Screens\Work;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\Works;
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

	private $portfolio;

	public function query( Works $portfolio ): array {
		$this->portfolio = $portfolio;

		if ( ! $portfolio->exists ) {
			$this->name        = 'Добавить';
			$this->description = 'Добавление новой записи';
		}

		$meta = [];
		foreach ( $portfolio->meta as $item ):
			$meta = (array) $item->getAttributes();
		endforeach;

		return [
			'portfolio' => $portfolio,
			'title'     => $portfolio->title,
			'meta'      => $meta
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
			'portfolio.slug'  => $slug,
			'portfolio.title' => $title
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
					new SlugEditListener( 'portfolio' ),
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

	public function save( Works $portfolio, Request $request ) {
		$request->validate( [
			'portfolio.title' => [
				'required',
				Rule::unique( Works::class, 'title' )->ignore( $portfolio ),
			],
			'portfolio.slug'  => [
				'required',
				'regex:/[a-zA-Z0-9-]/',
				Rule::unique( Works::class, 'slug' )->ignore( $portfolio ),
			],
		] );

		$pageData = $request->get( 'portfolio' );
		$metaData = $request->get( 'meta' );

		$portfolio->fill( $pageData );
		$portfolio->save();
		if ( count( $portfolio->meta ) > 0 ):
			$portfolio->meta()->update( $metaData );
		else:
			$portfolio->meta()->create( $metaData );
		endif;
		$portfolio->save();

		Toast::info( 'Страница сохранена!' );

		return redirect()->route( 'platform.portfolio' );
	}

	public function remove( Works $portfolio ) {
		$portfolio->delete();

		Toast::info( 'Страница удалена' );

		return redirect()->route( 'platform.portfolio' );
	}

	public function cancel() {
		return redirect()->route( 'platform.portfolio' );
	}
}
