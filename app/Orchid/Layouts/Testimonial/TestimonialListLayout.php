<?php

declare( strict_types=1 );

namespace App\Orchid\Layouts\Testimonial;

use Illuminate\Support\Carbon;
use App\Models\Testimonial;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Screen\Fields\Group;

class TestimonialListLayout extends Table {

	public $target = 'testimonials';

	public function columns(): array {
		return [
			TD::make( 'published', '' )
			  ->align( 'left' )
			  ->cantHide()
			  ->width( '30px' )
			  ->render( function ( $testimonials ) {
				  $color = '#eff1f9';
				  if ( $testimonials->published == 1 ) {
					  $color = '#43d040';
				  }

				  return '<span style="display: block;width: 16px;height: 16px;border-radius: 50%;background: ' . $color . ';"></span>';
			  } ),
			TD::make( 'img_cover', '' )
			  ->align( 'left' )
			  ->cantHide()
			  ->render( function ( $testimonials ) {
				  //return "<img src='https://picsum.photos/450/200?random={" . $testimonials->id . "}' class='mw-100 d-block img-fluid'>";
				  return '<img src="' . $testimonials->img_cover . '" class="mw-100 d-block img-fluid">';
			  } ),
			TD::make( 'title', 'Заголовок' )
			  ->align( 'left' )
			  ->cantHide()
			  ->width( '60%' )
			  ->render( function ( $testimonials ) {
				  return '<strong><a href=' . route( 'platform.testimonials.edit', $testimonials ) . '>' . $testimonials->title . '</a></strong>';
			  } )
			  ->sort(),
			TD::make( 'created_at', 'Размещено' )
			  ->align( 'right' )
			  ->cantHide()
			  ->width( '220px' )
			  ->render( function ( $testimonials ) {
				  return '<span class="text-muted">Обновлено: ' . Carbon::parse( $testimonials->updated_at )->format( 'd.m.Y H:i:s' ) . '</span><br><span class="text-muted">Размещено: ' . Carbon::parse( $testimonials->created_at )->format( 'd.m.Y H:i:s' ) . '</span>';
			  } )
			  ->sort(),
			TD::make( __( 'Действия' ) )
			  ->align( TD::ALIGN_CENTER )
			  ->width( '130px' )
			  ->render( function ( Testimonial $testimonials ) {
				  return Group::make( [
					  Button::make( '' )->method( 'buttonClickProcessing' )->type( Color::PRIMARY() )->icon( 'pencil' )->route( 'platform.testimonials.edit', $testimonials->id ),
					  Button::make( '' )->method( 'buttonClickProcessing' )->type( Color::DANGER() )->icon( 'trash' )->method( 'remove' )->confirm( 'Как только запись будет удалена, все ее ресурсы и данные будут удалены безвозвратно.' )->parameters( [
						  'slug' => $testimonials->id,
					  ] )
				  ] )->autoWidth();


				  /* return DropDown::make()
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
								  ] );*/
			  } ),
		];
	}
}
