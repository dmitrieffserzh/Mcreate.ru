<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Layouts\Listener;

class SlugEditListener extends Listener {

	protected $targets = [
		'title'
	];

	protected $asyncMethod = 'asyncSlugEdit';

	private $prefix;

	public function __construct( $prefix ) {
		$this->prefix = $prefix;
	}


	protected function layouts(): array {
		return [
			Layout::rows( [
				Input::make( $this->prefix . '.slug' )
				     ->title( 'Введите "SLUG"' )
				     ->placeholder( 'Введите SLUG' )
				     ->help( "Допускоется введение символов a-z, A-Z, 0-9 и -" )
				     ->style( 'width: 100%; max-width: 100%;' )
				     ->mask( [
					     'regex' => '[a-zA-Z0-9-]*'
				     ] )
				     ->required(),
				Input::make( $this->prefix . '.title' )->hidden( 'true' )
			] )

		];
	}
}
