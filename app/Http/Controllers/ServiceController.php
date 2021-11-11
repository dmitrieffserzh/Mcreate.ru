<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Work;
use Illuminate\Http\Request;

class ServiceController extends Controller {

	public function show( $slug ) {
		$service  = Service::where( 'slug', '=', $slug )->get()->load( 'meta' );

		return view( 'pages.page-service', [
			'service'  => $service,
		] );
	}
}
