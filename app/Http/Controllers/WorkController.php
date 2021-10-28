<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function index () {
    	return "ЖОПА";
    }

	public function show ($slug) {
		$work = Work::where( 'slug', '=', $slug )->get()->load( 'meta' )->toArray();
		$works = Work::all()->toArray();

		return view( 'pages.page-work-show', [
			'work' => $work,
			'works' => $works
		] );
	}
}
