<?php

namespace App\Http\Controllers;

use App\Models\Works;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function index () {
    	return "ЖОПА";
    }



	public function show ($slug) {
		$work = Works::where( 'slug', '=', $slug )->get()->load( 'meta' )->toArray();

		return view( 'pages.page-work-show', [
			//'page'      => $page,
			'work' => $work
		] );
	}
}
