<?php

namespace App\Orchid\Screens\Page;

use App\Models\Page;
use App\Orchid\Layouts\Page\PageListLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;

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
	    return [
		    'pages' => Page::all()
		                   //->filters()
		                   //->filtersApplySelection(UserFiltersLayout::class)
		                   //->defaultSort('id', 'desc')
		                   //paginate(),
	    ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
	        Link::make(__('Добавить страницу'))
	            ->icon('plus')
	            ->href(route('platform.pages.create')),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
	    return [
		    PageListLayout::class,
	    ];
    }
}
