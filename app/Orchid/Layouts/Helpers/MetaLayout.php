<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Helpers;

use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;

class MetaLayout extends Rows
{
    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
	        Input::make( 'meta_title' )
	             ->title( 'META TITLE' )
	             ->placeholder( 'Введите заголовок страницы' )
	             ->style( 'width: 100%; max-width: 100%;' ),
	        Input::make( 'meta_keywords' )
	             ->title( 'META KEYWORDS' )
	             ->placeholder( 'Введите ключевые слова страницы' )
	             ->style( 'width: 100%; max-width: 100%;' ),
	        TextArea::make( 'meta_description' )
	                ->rows( 5 )
	                ->title( 'META DESCRIPTION' )
	                ->placeholder( 'Введите описание страницы' )
	                ->style( 'width: 100%; max-width: 100%;' ),
        ];
    }
}
