<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'pages', function ( Blueprint $table ) {
			$table->id();
			$table->integer( 'parent_id' );
			$table->integer( 'published' )->unsigned()->default( 1 );
			$table->string( 'title' );
			$table->string( 'slug' )->unique();
			$table->longText( 'content' );
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'pages' );
	}
}
