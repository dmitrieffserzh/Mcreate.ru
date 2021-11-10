<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
	public function show ($slug) {
		$work = Work::where( 'slug', '=', $slug )->firstOrFail()->load( 'meta', 'testimonials' );
        $works = Work::where('id', '!=' , $work['id'])->limit(6)->get();

		$work['work']    = json_decode( $work['work'], true );
		$work['results'] = json_decode( $work['results'], true );

		return view( 'pages.page-work-show', [
			'work' => $work,
			'works' => $works
		] );
	}
}
