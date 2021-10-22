<?php

declare( strict_types=1 );

namespace App\Orchid\Layouts\Settings;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class SettingsEditLayout extends Rows {

	public function fields(): array {
		return [
			Input::make('settings.phone')
			     ->type('tel')
			     ->title('Телефон')
			     ->placeholder('+7 (915) 455-33-99)')
			     ->horizontal(),
			Input::make('settings.email')
			     ->type('email')
			     ->title('E-mail')
			     ->placeholder('example@eample.com')
			     ->horizontal(),
			Input::make('settings.address')
			     ->title('Адрес')
			     ->help('')
			     ->horizontal(),
		];
	}
}
