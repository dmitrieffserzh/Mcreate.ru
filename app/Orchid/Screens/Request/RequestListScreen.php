<?php

namespace App\Orchid\Screens\Request;

use App\Models\RequestForm;
use App\Orchid\Layouts\Request\RequestListLayout;
use Orchid\Screen\Screen;

class RequestListScreen extends Screen {

	public $name = 'Заявки на обратный звонок';

	public $description = '';

	public function query(): array {
		return [
			'result' => RequestForm::filters()->where( 'type', '=', 'callback' )->defaultSort( 'id', 'desc' )->paginate( 30 )
		];
	}

	public function commandBar(): array {
		return [];
	}

	public function layout(): array {
		return [
			RequestListLayout::class,
		];
	}
}
