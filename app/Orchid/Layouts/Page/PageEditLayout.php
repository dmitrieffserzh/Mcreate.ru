<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Page;

use App\Models\Page;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;

class PageEditLayout extends Rows
{

    public function fields(): array
    {
        return [
        	Group::make([
        		Input::make('title')
		             ->title('Заголовок')
		             ->placeholder('Введите заголовок страницы')
		             ->style( 'width: 100%; max-width: 100%;' )
		             ->required(),
		        ]),

	        Group::make([
		        Relation::make('page.')
		                ->fromModel(Page::class, 'title', "parent_id")
		                ->title('Вложенность'),

	            RadioButtons::make('page.published')
	                    ->title('Активность')
	                    ->options([
		                    1 => 'Активна',
		                    0 => 'Не активна',
	                    ])
	                    ->value(1),
	        ]),

	        Quill::make('page.content')
	             ->title('')
	             ->popover(''),

        ];
    }
}
