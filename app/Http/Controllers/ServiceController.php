<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller {
	public function show( $slug ) {
		$service  = Service::where( 'slug', '=', $slug )->get()->load( 'meta' )->toArray();
		$services = Service::all()->toArray();

		return view( 'pages.page-work-show', [
			'service'  => $service,
			'services' => $services
		] );
	}
}
