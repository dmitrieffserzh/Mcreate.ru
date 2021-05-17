<?php

namespace App\Orchid\Screens\Testimonial;

use App\Models\Testimonial;
use App\Orchid\Layouts\Testimonial\TestimonialListLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;

class TestimonialListScreen extends Screen {

	public $name = 'Страницы';

	public $description = 'Список всех страниц';

	public function query(): array {

		$testimonials = Testimonial::filters()->defaultSort('created_at', 'desc')->paginate( 15 );


		return [

			'testimonials' => $testimonials
			//->filters()
			//->filtersApplySelection(UserFiltersLayout::class)
			//->defaultSort('id', 'desc')
			//paginate(),
		];
	}

	public function commandBar(): array {
		return [
			Link::make( __( 'Добавить запись' ) )
			    ->icon( 'plus' )
			    ->href( route( 'platform.testimonials.create' ) ),
		];
	}

	public function layout(): array {
		return [
			TestimonialListLayout::class,
		];
	}

	public function remove(Testimonial $testimonials)
	{
		$testimonials->delete();

		Toast::info('Страница удалена');

		return redirect()->route('platform.testimonials');
	}
}
