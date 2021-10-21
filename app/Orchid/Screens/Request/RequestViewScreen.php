<?php

namespace App\Orchid\Screens\Request;

use Illuminate\Support\Carbon;
use App\Models\RequestForm;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Sight;
use Orchid\Screen\Screen;

class RequestViewScreen extends Screen {

	public $name = 'Заявка на обратный звонок';

	public $description = 'Просмотр заявки';

	private $request;

	public function query( RequestForm $request ): array {
		$this->callback = $request;

		return [
			'result' => $request
		];
	}

	public function commandBar(): array {
		return [];
	}

	public function layout(): array {
		return [
			Layout::legend( 'result', [
				Sight::make( 'id', 'Номер заявки' ),
				Sight::make( 'name', 'Имя:' ),
				Sight::make( 'phone', 'Телефон:' )
				     ->render( function ( $result ) {
					     return $this->phone_format( $result['phone'] );
				     } ),
				Sight::make( 'message', 'Сообщение:' ),
				Sight::make( 'page_url', 'Источник:' ),
				//Sight::make( 'utm_source', 'UTM-метка:' ),
				Sight::make( 'ip', 'IP-дрес:' ),
				Sight::make( 'user_agent', 'User-Agent:' ),
				Sight::make( 'created_at', 'Размещено:' )
				     ->render( function ( $callback ) {
					     return Carbon::parse( $callback->created_at )->format( 'd.m.Y H:i:s' );
				     } ),
				Sight::make( 'updated_at', 'Обновлено:' )
				     ->render( function ( $callback ) {
					     return Carbon::parse( $callback->updated_at )->format( 'd.m.Y H:i:s' );
				     } ),
			] )->title( '' ),
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
