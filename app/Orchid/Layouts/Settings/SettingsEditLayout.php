<?php

declare( strict_types=1 );

namespace App\Orchid\Layouts\Settings;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class SettingsEditLayout extends Rows {

	public function fields(): array {
		return [

			Input::make('telephone')
			     ->type('tel')
			     ->title('Телефон')
			     ->value('+7(999)-999-99-99')
			     ->horizontal(),
			Input::make('email')
			     ->type('email')
			     ->title('E-mail')
			     ->value('example@example.com')
			     ->help('')
			     ->horizontal(),
			Input::make('address')
			     ->title('Адрес')
			     ->value('')
			     ->help('')
			     ->horizontal(),
		];
	}
}
