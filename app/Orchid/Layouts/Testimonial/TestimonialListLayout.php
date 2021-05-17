<?php

declare( strict_types=1 );

namespace App\Orchid\Layouts\Testimonial;

use Orchid\Screen\Repository;

use App\Models\Testimonial;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TestimonialListLayout extends Table {
	/**
	 * @var string
	 */
	public $target = 'testimonials';

	/**
	 * @return TD[]
	 */
	public function columns(): array {
		return [
			/*TD::make( 'published', '' )
			  ->align( 'left' )
			  ->cantHide()
			  ->width( '30px' )
			  ->render( function ( $testimonials ) {
			  	    $color = '#eff1f9';
			  	    if($pages->published == 1)
				        $color = '#43d040';

				  return '<span style="display: block;width: 16px;height: 16px;border-radius: 50%;background: '.$color.';"></span>';
			  } ),*/
			TD::make( 'img_cover', '' )
			  ->align( 'left' )
			  ->cantHide()
				//->width( '30px' )
              ->render( function ( $testimonials ) {
					return "<img src='https://picsum.photos/450/200?random={" . $testimonials->id . "}' class='mw-100 d-block img-fluid'>";
				} ),
			TD::make( 'title', 'Заголовок' )
			  ->align( 'left' )
			  ->cantHide()
			  ->width( '80%' )
			  ->render( function ( $testimonials ) {
				  return '<strong><a href=' . route( 'platform.testimonials.edit', $testimonials ) . '>' . $testimonials->title . '</a></strong>';
			  } ),
			/*TD::make( 'slug', 'Slug' )
			  ->align( 'left' )
			  ->cantHide()
			  ->render( function ( $pages ) {
				  return $pages->slug;
			  } ),*/
			TD::make( __( '' ) )
			  ->align( TD::ALIGN_CENTER )
			  ->width( '50px' )
			  ->render( function ( Testimonial $testimonials ) {
				  return DropDown::make()
				                 ->icon( 'options-vertical' )
				                 ->list( [
					                 Link::make( __( 'Edit' ) )
					                     ->route( 'platform.testimonials.edit', $testimonials->id )
					                     ->icon( 'pencil' ),
					                 Button::make( __( 'Delete' ) )
					                       ->icon( 'trash' )
					                       ->method( 'remove' )
					                       ->confirm( 'Как только запись будет удалена, все ее ресурсы и данные будут удалены безвозвратно.' )
					                       ->parameters( [
						                       'slug' => $testimonials->id,
					                       ] ),
				                 ] );
			  } ),
		];
	}
}
