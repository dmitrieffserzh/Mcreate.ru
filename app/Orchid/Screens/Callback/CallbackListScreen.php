<?php

namespace App\Orchid\Screens\Callback;

use App\Models\Request;
use App\Orchid\Layouts\Callback\CallbackListLayout;
use Orchid\Screen\Screen;

class CallbackListScreen extends Screen {

	public $name = 'Заявки на обратный звонок';

	public $description = '';

	public function query(): array {
		return [
			'result' => Request::filters()->where( 'type', '=', 'callback' )->defaultSort( 'created_at', 'desc' )->paginate( 15 )
		];
	}

	public function commandBar(): array {
		return [];
	}

	public function layout(): array {
		return [
			CallbackListLayout::class,
		];
	}
}
