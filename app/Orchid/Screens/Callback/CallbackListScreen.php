<?php

namespace App\Orchid\Screens\Callback;

use App\Models\Request;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Sight;

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
			Layout::legend( 'result', [
				Sight::make( 'result.id' ),
				Sight::make( 'result.name' ),
				Sight::make( 'result.phone' ),
				//Sight::make('email_verified_at', 'Email Verified')->render(function (Request $request) {
				//    return $request->agreement === null
				//        ? '<i class="text-danger">●</i> False'
				//        : '<i class="text-success">●</i> True';
				//}),
				Sight::make( 'result.created_at', 'Created' ),
				Sight::make( 'result.updated_at', 'Updated' ),
				/*Sight::make('Simple Text')->render(function () {
					return 'This is a wider card with supporting text below as a natural lead-in to additional content.
					This content is a little bit longer. Mauris a orci congue, placerat lorem ac, aliquet est.
					Etiam bibendum, urna et hendrerit molestie, risus est tincidunt lorem, eu suscipit tellus
							odio vitae nulla. Sed a cursus ipsum. Maecenas quis finibus libero. Phasellus a nibh rutrum,
							molestie orci sit amet, euismod ex. Donec finibus sodales magna, quis fermentum augue
							pretium ac.';
				}),*/
			] )->title( 'User' ),
		];
	}
}
