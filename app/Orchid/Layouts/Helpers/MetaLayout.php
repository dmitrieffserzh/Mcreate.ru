<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Helpers;

use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class MetaLayout extends Rows
{
    public function fields(): array
    {
        return [
	        Input::make( 'meta.title' )
	             ->title( 'META TITLE' )
	             ->placeholder( 'Введите заголовок страницы' )
	             ->style( 'width: 100%; max-width: 100%;' ),
	        Input::make( 'meta.keywords' )
	             ->title( 'META KEYWORDS' )
	             ->placeholder( 'Введите ключевые слова страницы' )
	             ->style( 'width: 100%; max-width: 100%;' ),
	        TextArea::make( 'meta.description' )
	                ->rows( 5 )
	                ->title( 'META DESCRIPTION' )
	                ->placeholder( 'Введите описание страницы' )
	                ->style( 'width: 100%; max-width: 100%;' ),
        ];
    }
}
