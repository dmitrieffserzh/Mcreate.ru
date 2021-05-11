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
	/**
	 * @var string
	 */
	public $target = 'pages';

	/**
	 * @return TD[]
	 */
	public function columns(): array {
		return [
			TD::make( 'title', 'Заголовок' )
			  ->align( 'left' )
			  ->cantHide()
			  ->render( function ( $pages ) {
				  return Link::make( $pages->title )
				             ->route( 'platform.pages.edit', $pages );
			  } ),
			TD::make( 'slug', 'Slug' )
			  ->align( 'left' )
			  ->cantHide()
			  ->render( function ( $pages ) {
				  return $pages->slug;
			  } ),
			TD::make( __( '' ) )
			  ->align( TD::ALIGN_CENTER )
			  ->width( '50px' )
			  ->render( function ( Page $pages ) {
				  return DropDown::make()
				                 ->icon( 'options-vertical' )
				                 ->list( [

					                 Link::make( __( 'Edit' ) )
					                     ->route( 'platform.pages.edit', $pages->id )
					                     ->icon( 'pencil' ),

					                 Button::make( __( 'Delete' ) )
					                       ->icon( 'trash' )
					                       ->method( 'remove' )
					                       ->confirm( __( 'Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.' ) )
					                       ->parameters( [
						                       'id' => $pages->id,
					                       ] ),
				                 ] );
			  } ),
		];
	}
}
