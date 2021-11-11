<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Work;
use Illuminate\Http\Request;

class ServiceController extends Controller {

    public function show( $slug ) {
        $service = Service::where( 'slug', '=', $slug )->firstOrFail()->load( 'meta' );
        $works   = Work::where( 'published', '=', 1 )->orderBy( 'created_at', 'desc' )->limit( 6 )->get();

        return view( 'pages.page-service', [
            'service' => $service,
            'works'   => $works
        ] );
    }
}
