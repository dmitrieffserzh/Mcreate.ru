<?php

declare( strict_types=1 );

namespace App\Orchid\Layouts\Portfolio;

use Illuminate\Support\Carbon;
use App\Models\Portfolio;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PortfolioListLayout extends Table {

	public $target = 'portfolio';

	public function columns(): array {
		return [
			/*TD::make( 'published', '' )
			  ->align( 'left' )
			  ->cantHide()
			  ->width( '30px' )
			  ->render( function ( $pages ) {
			  	    $color = '#eff1f9';
			  	    if($pages->published == 1)
				        $color = '#43d040';

				  return '<span style="display: block;width: 16px;height: 16px;border-radius: 50%;background: '.$color.';"></span>';
			  } ),*/
			TD::make( 'img_cover', '' )
			  ->align( 'left' )
			  ->cantHide()
				//->width( '30px' )
              ->render( function ( $portfolio ) {
					return "<img src='https://picsum.photos/450/200?random={" . $portfolio->id . "}' class='mw-100 d-block img-fluid'>";
				} ),
			TD::make( 'title', 'Заголовок' )
			  ->align( 'left' )
			  ->cantHide()
			  ->width( '60%' )
			  ->render( function ( $portfolio ) {
				  return '<strong><a href=' . route( 'platform.portfolio.edit', $portfolio ) . '>' . $portfolio->title . '</a></strong>';
			  } ),
			TD::make( 'created_at', 'Размещено' )
			  ->align( 'right' )
			  ->cantHide()
			  ->width( '220px' )
			  ->render( function ( $portfolio ) {
				  return '<span class="text-muted">Обновлено: ' . Carbon::parse( $portfolio->updated_at )->format( 'd.m.Y H:i:s' ) . '</span><br><span class="text-muted">Размещено: ' . Carbon::parse( $portfolio->created_at )->format( 'd.m.Y H:i:s' ) . '</span>';
			  } )
			  ->sort(),
			TD::make( __( '' ) )
			  ->align( TD::ALIGN_CENTER )
			  ->width( '50px' )
			  ->render( function ( Portfolio $portfolio ) {
				  return DropDown::make()
				                 ->icon( 'options-vertical' )
				                 ->list( [

					                 Link::make( __( 'Edit' ) )
					                     ->route( 'platform.portfolio.edit', $portfolio->id )
					                     ->icon( 'pencil' ),

					                 Button::make( __( 'Delete' ) )
					                       ->icon( 'trash' )
					                       ->method( 'remove' )
					                       ->confirm( 'Как только запись будет удалена, все ее ресурсы и данные будут удалены безвозвратно.' )
					                       ->parameters( [
						                       'slug' => $portfolio->id,
					                       ] ),
				                 ] );
			  } ),
		];
	}
}
