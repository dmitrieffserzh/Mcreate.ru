<?php

namespace App\Orchid\Screens\Settings;

use App\Models\Testimonial;
use App\Orchid\Layouts\Settings\SettingsEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Repository;
use Orchid\Support\Color;
use Orchid\Screen\Fields\Group;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class SettingsEditScreen extends Screen {

	public $name = 'Редактировать';

	public $description = 'Редактирование записи';

	public function query( Testimonial $testimonial ): array {

		if ( ! $testimonial->exists ) {
			$this->name        = 'Настройки';
			$this->description = 'Основные настройки сайта';
		}

		$settings = include(config_path().'/settings.php');

		return [
			'settings' => new Repository($settings ),
		];
	}

	public function commandBar(): array {
		return [
			Button::make( 'Отменить' )
			      ->method( 'cancel' )
			      ->type( Color::LIGHT() )
			      ->icon( 'close' ),
			Button::make( 'Сохранить' )
			      ->method( 'save' )
			      ->type( Color::LIGHT() )
			      ->icon( 'check' ),
		];
	}

	public function layout(): array {
		return [
				SettingsEditLayout::class,
				Layout::rows( [
				Group::make( [
					Button::make( 'Отменить' )
					      ->method( 'cancel' )
					      ->icon( 'close' )
					      ->class( 'float-start btn btn-' . Color::SECONDARY() ),
					Button::make( 'Сохранить' )
					      ->method( 'save' )
					      ->icon( 'check' )
					      ->class( 'float-end btn btn-' . Color::PRIMARY() ),
				] )
			] )
		];
	}

	public function save( Request $request ) {

		config(['settings.email' => 'NEW_VALUE', 'settings.phone' => '+79154553399']);
		$text = '<?php return ' . var_export(config('settings'), true) . ';';
		file_put_contents(config_path('settings.php'), $text);

		Toast::info( 'Настройки сохранены!' );

		return redirect()->route( 'platform.settings' );
	}


	public function cancel() {
		return redirect()->route( 'platform.settings' );
	}
}