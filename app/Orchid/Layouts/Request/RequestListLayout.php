<?php

declare( strict_types=1 );

namespace App\Orchid\Layouts\Request;

use Illuminate\Support\Carbon;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class RequestListLayout extends Table {

	public $target = 'result';

	public function columns(): array {
		return [
			TD::make( 'id', '' )
			  ->align( 'left' )
			  ->cantHide()
			  ->width( '80px' )
			  ->render( function ( $result ) {
				  return '<span style="display: block;word-break: inherit;">№ ' . $result['id'] . '</span>';
			  } ),
			TD::make( 'name', 'Имя' )
			  ->align( 'left' )
			  ->cantHide()
			  ->width( '20%' )
			  ->render( function ( $result ) {
				  return '<strong><a href=' . route( 'platform.requests.view', $result['id'] ) . '>' . $result['name'] . '</a></strong>';
			  } ),
			TD::make( 'phone', 'Телефон' )
			  ->align( 'left' )
			  ->cantHide()
			  ->render( function ( $result ) {
				  return $this->phone_format( $result['phone'] );
			  } ),
			TD::make( 'created_at', 'Размещено' )
			  ->align( 'right' )
			  ->cantHide()
			  ->width( '230px' )
			  ->render( function ( $result ) {
				  return '<span class="text-muted">Обновлено: ' . Carbon::parse( $result->updated_at )->format( 'd.m.Y H:i:s' ) . '</span><br><span class="text-muted">Размещено: ' . Carbon::parse( $result->created_at )->format( 'd.m.Y H:i:s' ) . '</span>';
			  } )
			  ->sort(),
			TD::make( __( 'Действия' ) )
			  ->align( TD::ALIGN_CENTER )
			  ->width( '50px' )
			  ->render( function ( $result ) {
				  return DropDown::make()
				                 ->icon( 'options-vertical' )
				                 ->list( [

					                 Link::make( 'Просмотреть' )
					                     ->route( 'platform.requests.view', $result['id'] )
					                     ->icon( 'eye' ),

					                 Button::make( __( 'Delete' ) )
					                       ->icon( 'trash' )
					                       ->method( 'remove' )
					                       ->confirm( 'Как только запись будет удалена, все ее ресурсы и данные будут удалены безвозвратно.' )
					                       ->parameters( [
						                       'id' => $result['id'],
					                       ] ),
				                 ] );
			  } ),
		];
	}

	public function phone_format( $phone ) {
		$phone = trim( $phone );

		$res = preg_replace(
			array(
				'/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{3})[-|\s]?\)[-|\s]?(\d{3})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
				'/[\+]?([7|8])[-|\s]?(\d{3})[-|\s]?(\d{3})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
				'/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{4})[-|\s]?\)[-|\s]?(\d{2})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
				'/[\+]?([7|8])[-|\s]?(\d{4})[-|\s]?(\d{2})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
				'/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{4})[-|\s]?\)[-|\s]?(\d{3})[-|\s]?(\d{3})/',
				'/[\+]?([7|8])[-|\s]?(\d{4})[-|\s]?(\d{3})[-|\s]?(\d{3})/',
			),
			array(
				'+7 ($2) $3-$4-$5',
				'+7 ($2) $3-$4-$5',
				'+7 ($2) $3-$4-$5',
				'+7 ($2) $3-$4-$5',
				'+7 ($2) $3-$4',
				'+7 ($2) $3-$4',
			),
			$phone
		);

		return $res;
	}
}
