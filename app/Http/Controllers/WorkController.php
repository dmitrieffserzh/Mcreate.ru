<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function index () {
    	return "ЖОПА";
    }



	public function show ($slug) {
		$work = Portfolio::where( 'slug', '=', $slug )->get()->load( 'meta' )->toArray();

		return view( 'pages.page-work-show', [
			//'page'      => $page,
			'work' => $work
		] );
	}
}
