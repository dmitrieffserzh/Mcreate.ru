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
    	$gpages  = Page::all();
		$pages = [];
	    foreach ($gpages as $page):
		    array_push($pages,$page);
	    endforeach;

	    $basePage = array_filter($pages, function($obj){
		    if($obj->parent_id == 0) {
			    return true;
		    }
		    return false;
	    });

	    for ($i = 1; $i < count($basePage); $i++) {
		    $basePage[$i]['subpage'] = $this->getSubparrent( $basePage[$i], $pages );

	    }
	    print_r($basePage);
	    return [
		    'pages' => $basePage
		                   //->filters()
		                   //->filtersApplySelection(UserFiltersLayout::class)
		                   //->defaultSort('id', 'desc')
		                   //paginate(),
	    ];
    }

    public function getSubparrent($basePage, $pagess) : array {
	    $subPages = array_filter($pagess, function($obj) use ($basePage){

		    if($obj->parent_id == $basePage->id) {
			    return true;
		    }
		    return false;
	    });
	    for ($i = 1; $i < count($subPages); $i++) {
		    $subPages[$i]->subpage = $this->getSubparrent( $subPages[$i], $pagess );
	    }

	    return $subPages;
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
