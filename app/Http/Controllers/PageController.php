<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller {

	public function getPage($path) {

		$path = explode('/', $path);
		$slug = end($path);

		$pageAll = Page::where('published', '=', 1)->get()->toArray();
		$page = array_filter($pageAll, function ($obj) use ($slug) {
			if($obj['slug'] == $slug)
				return true;
			return false;
		});
		print_r($page);

		$pageUrl = $this->constructPage($pageAll, $page);









		/*

		mainPage = filterPage(pageAll);

		pageUrl = constructPage(mainPage,pageAll);

		requestUrl

if(requestUrl == pageUrl) ok;

function constructPage(mainPage,pageAll){
	result = '';
	if(mainPage.parentId == 0) return parent.slag . '/';
	parent = array_filter(pageAll, function (obj) { return mainPage.parentId = obj.Id; })
	if(isset(parent) && parent['parentId'] != 0)
		result = constructPage(parent,pageAll) . parent.slag . '/';
	else
		result = parent.slag . '/'
	return result
}
		*/











		$path = explode('/', $path);
		$slug = end($path);

		$page = Page::where( 'slug', $slug )->firstOrFail();


		dd($page->parent()->get());
		return view( 'pages.page', [
			'page' => $page
		]);
	}

	public function constructPage( $pageAll, $page ) {

		if($page['parent_id'] == 0)
			return $page['slug'] . '/';

		$parent = array_filter($pageAll, function ($obj) use ($page) {
			return $page['parent_id'] = $obj['id'];
		});
		if(isset($parent) && $parent[1]['parent_id'] != 0)
			$result = $this->constructPage($parent, $pageAll) . $page['slag'] . '/';
		else
			$result = $page['slag'] . '/';
		return $result;
	}


}