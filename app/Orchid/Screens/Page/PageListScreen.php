<?php

namespace App\Orchid\Screens\Page;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;

class PageListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Страницы';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Список страниц';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
	        Button::make('Добавить страницу')
	              ->method('showToast')
	              ->novalidate()
	              ->icon('plus'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [];
    }
}
