<?php

declare( strict_types=1 );

namespace App\Orchid\Layouts\Page;

use App\Models\Page;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PageListLayout extends Table {

	public $target = 'pages';

	public function columns(): array {
		return [
			TD::make( 'published', '' )
			  ->align( 'left' )
			  ->cantHide()
			  ->width( '30px' )
			  ->render( function ( $pages ) {
				  $color = '#eff1f9';
				  if ( $pages['published'] == 1 ) {
					  $color = '#43d040';
				  }

				  return '<span style="display: block;width: 16px;height: 16px;border-radius: 50%;background: ' . $color . ';"></span>';
			  } ),
			TD::make( 'title', 'Заголовок' )
			  ->align( 'left' )
			  ->cantHide()
			  ->width( '30%' )
			  ->render( function ( $pages ) {
				  return '<strong><a href=' . route( 'platform.pages.edit', $pages['slug'] ) . '>' . $pages['title'] . '</a></strong>';
			  } ),
			TD::make( 'slug', 'Slug' )
			  ->align( 'left' )
			  ->cantHide()
			  ->render( function ( $pages ) {
				  return $pages['slug'];
			  } ),
			TD::make( __( '' ) )
			  ->align( TD::ALIGN_CENTER )
			  ->width( '50px' )
			  ->render( function ( $pages ) {
				  return DropDown::make()
				                 ->icon( 'options-vertical' )
				                 ->list( [

					                 Link::make( __( 'Edit' ) )
					                     ->route( 'platform.pages.edit', $pages['slug'] )
					                     ->icon( 'pencil' ),

					                 Button::make( __( 'Delete' ) )
					                       ->icon( 'trash' )
					                       ->method( 'remove' )
					                       ->confirm( 'Как только запись будет удалена, все ее ресурсы и данные будут удалены безвозвратно.' )
					                       ->parameters( [
						                       'slug' => $pages['slug'],
					                       ] ),
				                 ] );
			  } ),
		];
	}
}
