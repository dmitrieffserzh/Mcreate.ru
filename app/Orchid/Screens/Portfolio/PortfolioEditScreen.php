<?php

namespace App\Orchid\Screens\Portfolio;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\Portfolio;
use App\Orchid\Layouts\SlugEditListener;
use App\Orchid\Layouts\Helpers\MetaLayout;
use App\Orchid\Layouts\Portfolio\PortfolioEditLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Color;
use Orchid\Screen\Fields\Group;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class PortfolioEditScreen extends Screen {

	public $name = 'Редактировать';

	public $description = 'Редактирование записи';

	private $portfolio;

	public function query( Portfolio $portfolio ): array {
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
					PortfolioEditLayout::class,
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

	public function save( Portfolio $portfolio, Request $request ) {
		$request->validate( [
			'portfolio.title' => [
				'required',
				Rule::unique( Portfolio::class, 'title' )->ignore( $portfolio ),
			],
			'portfolio.slug'  => [
				'required',
				'regex:/[a-zA-Z0-9-]/',
				Rule::unique( Portfolio::class, 'slug' )->ignore( $portfolio ),
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

	public function remove( Portfolio $portfolio ) {
		$portfolio->delete();

		Toast::info( 'Страница удалена' );

		return redirect()->route( 'platform.portfolio' );
	}

	public function cancel() {
		return redirect()->route( 'platform.portfolio' );
	}

	/*

		public function save(User $user, Request $request)
		{
			$request->validate([
				'user.email' => [
					'required',
					Rule::unique(User::class, 'email')->ignore($user),
				],
			]);

			$permissions = collect($request->get('permissions'))
				->map(function ($value, $key) {
					return [base64_decode($key) => $value];
				})
				->collapse()
				->toArray();

			$userData = $request->get('user');
			if ($user->exists && (string)$userData['password'] === '') {
				// When updating existing user null password means "do not change current password"
				unset($userData['password']);
			} else {
				$userData['password'] = Hash::make($userData['password']);
			}

			$user
				->fill($userData)
				->fill([
					'permissions' => $permissions,
				])
				->save();

			$user->replaceRoles($request->input('user.roles'));

			Toast::info(__('User was saved.'));

			return redirect()->route('platform.systems.users');
		}


		public function remove(User $user)
		{
			$user->delete();

			Toast::info(__('User was removed'));

			return redirect()->route('platform.systems.users');
		}


	*/


}
