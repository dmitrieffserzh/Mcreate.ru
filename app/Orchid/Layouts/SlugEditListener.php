<?php

namespace App\Orchid\Layouts;

use App\Orchid\Layouts\Page\PageEditLayout;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Layouts\Listener;

class SlugEditListener extends Listener
{
    /**
     * List of field names for which values will be listened.
     *
     * @var string[]
     */
    protected $targets = [
    	'title'
    ];

    /**
     * What screen method should be called
     * as a source for an asynchronous request.
     *
     * The name of the method must
     * begin with the prefix "async"
     *
     * @var string
     */
    protected $asyncMethod = 'asyncSlugEdit';

    /**
     * @return Layout[]
     */
    protected function layouts(): array
    {
        return [
	        Layout::rows([
	        	Input::make('page.slug')
		             ->title('Введите "SLUG"')
		             ->placeholder()
		             ->help("Допускоется введение символов a-z, 0-9 и _-")
		             ->style( 'width: 100%; max-width: 100%;' )
		             ->required(),
		        Input::make('page.title')
		             ->hidden()
	        ])

        ];
    }
}
