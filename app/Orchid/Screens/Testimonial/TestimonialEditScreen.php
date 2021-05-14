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

class TestimonialEditScreen extends Screen {

	public $name = 'Редактировать';

	public $description = 'Редактирование записи';

	private $testimonial;

	public function query( Testimonial $testimonial ): array {
		$this->$testimonial = $testimonial;

		if ( ! $testimonial->exists ) {
			$this->name        = 'Добавить';
			$this->description = 'Добавление новой записи';
		}

		return [
			'portfolio'  => $testimonial,
			'title' => $testimonial->title
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
			'$testimonial.slug'  => $slug,
			'$testimonial.title' => $title
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
					new SlugEditListener('testimonial'),
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

	public function save( Testimonial $testimonial, Request $request ) {
		$request->validate( [
			'portfolio.title' => [
				'required',
				Rule::unique( Testimonial::class, 'title' )->ignore( $testimonial ),
			],
			'portfolio.slug'  => [
				'required',
				'regex:/[a-zA-Z0-9-]/',
				Rule::unique( Testimonial::class, 'slug' )->ignore( $testimonial ),
			],
		] );

		$pageData = $request->get( 'testimonial' );

		$testimonial->fill( $pageData )
		     ->save();

		Toast::info( 'Страница сохранена!' );

		return redirect()->route( 'platform.testimonials' );
	}

	public function remove( Portfolio $testimonial ) {
		$testimonial->delete();

		Toast::info( 'Страница удалена' );

		return redirect()->route( 'platform.testimonials' );
	}

	public function cancel() {
		return redirect()->route( 'platform.testimonials' );
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
