<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimonialsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'testimonials', function ( Blueprint $table ) {
			$table->id();
			$table->integer( 'published' )->unsigned()->default( 1 );
			$table->string( 'title' );
			$table->string( 'slug' );
			$table->text( 'content' );
			$table->string( 'img_cover' )->nullable();
			$table->string( 'img_main' )->nullable();
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'testimonials' );
	}
}
