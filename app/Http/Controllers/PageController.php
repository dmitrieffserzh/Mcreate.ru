<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Work;
use App\Models\Testimonial;

class PageController extends Controller {


	public function index() {
		$page         = Page::where( 'published', '=', 1 )->where( 'slug', '=', 'main' )->firstOrFail()->load( 'meta' )->toArray();
		$works        = Work::all()->toArray();
		$testimonials = Testimonial::all()->toArray();

		return view( 'pages.main', [
			'page'         => $page,
			'works'        => $works,
			'testimonials' => $testimonials
		] );
	}

	public function getPage( $path ) {

		$pathSp = explode( '/', $path );
		$slug   = end( $pathSp );

		$pageAll = Page::where( 'published', '=', 1 )->get()->load( 'meta' )->toArray();

		$page = array_filter( $pageAll, function ( $obj ) use ( $slug ) {
			if ( $obj['slug'] == $slug ) {
				return true;
			}

			return false;
		} );

		$page = array_shift( $page );
		if ( is_null( $page ) ) {
			abort( 404 );
		}

		$pageUrl = $this->constructPage( $pageAll, $page );
		$pageUrl = rtrim( $pageUrl, "/" );

		if ( $path != $pageUrl ) {
			abort( 404 );
		}

		$works        = Work::all()->toArray();
		$testimonials = Testimonial::all()->toArray();

		$url     = url()->current();
		$segment = explode( "/", $url );


		return view( 'pages.page-' . end( $segment ), [
			'page'         => $page,
			'works'        => $works,
			'testimonials' => $testimonials,
			'segment'      => $segment
		] );
	}

	public function constructPage( $pageAll, $page ) {
		$result = '';
		if ( $page['parent_id'] == 0 ) {
			return $page['slug'] . '/';
		}

		$parent = array_filter( $pageAll, function ( $obj ) use ( $page ) {
			return $page['parent_id'] == $obj['id'];
		} );
		$parent = array_shift( $parent );

		if ( ! is_null( $parent ) ) {
			$result = $this->constructPage( $pageAll, $parent ) . $page['slug'] . '/';

		} else {
			$result = $page['slug'] . '/';
		}

		return $result;
	}
}