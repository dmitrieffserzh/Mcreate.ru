<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller {


	public function index() {
		$page = Page::where( 'published', '=', 1 )->where( 'slug', '=', 'glavnaya-stranica' )->firstOrFail()->load( 'meta' )->toArray();

		return view( 'pages.page', [
			'page' => $page
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


		return view( 'pages.page', [
			'page' => $page
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