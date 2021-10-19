<?php

declare( strict_types=1 );

namespace App\Orchid\Layouts\Work;

use Illuminate\Support\Carbon;
use App\Models\Work;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class WorkListLayout extends Table {

	public $target = 'works';

	public function columns(): array {
		return [
			TD::make( 'published', '' )
			  ->align( 'left' )
			  ->cantHide()
			  ->width( '30px' )
			  ->render( function ( $works ) {
				  $color = '#eff1f9';
				  if ( $works->published == 1 ) {
					  $color = '#43d040';
				  }

				  return '<span style="display: block;width: 16px;height: 16px;border-radius: 50%;background: ' . $color . ';"></span>';
			  } ),
			TD::make( 'img_cover', '' )
			  ->align( 'left' )
			  ->cantHide()
				//->width( '30px' )
              ->render( function ( $works ) {
					return '<img src="' . $works->img_cover . '" class="mw-100 d-block img-fluid">';
				} ),
			TD::make( 'title', 'Заголовок' )
			  ->align( 'left' )
			  ->cantHide()
			  ->width( '60%' )
			  ->render( function ( $works ) {
				  return '<strong><a href=' . route( 'platform.works.edit', $works ) . '>' . $works->title . '</a></strong>';
			  } ),
			TD::make( 'created_at', 'Размещено' )
			  ->align( 'right' )
			  ->cantHide()
			  ->width( '220px' )
			  ->render( function ( $works ) {
				  return '<span class="text-muted">Обновлено: ' . Carbon::parse( $works->updated_at )->format( 'd.m.Y H:i:s' ) . '</span><br><span class="text-muted">Размещено: ' . Carbon::parse( $works->created_at )->format( 'd.m.Y H:i:s' ) . '</span>';
			  } )
			  ->sort(),
			TD::make( __( 'Действия' ) )
			  ->align( TD::ALIGN_CENTER )
			  ->width( '50px' )
			  ->render( function ( Work $works ) {
				  return DropDown::make()
				                 ->icon( 'options-vertical' )
				                 ->list( [

					                 Link::make( __( 'Edit' ) )
					                     ->route( 'platform.works.edit', $works->id )
					                     ->icon( 'pencil' ),

					                 Button::make( __( 'Delete' ) )
					                       ->icon( 'trash' )
					                       ->method( 'remove' )
					                       ->confirm( 'Как только запись будет удалена, все ее ресурсы и данные будут удалены безвозвратно.' )
					                       ->parameters( [
						                       'slug' => $works->id,
					                       ] ),
				                 ] );
			  } ),
		];
	}
}
