<?php

namespace App\Models;

use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
	use HasFactory;
	use AsSource;
	use Filterable;

	public $fillable = [
		'published',
		'title',
		'content',
		'img_cover',
		'img_main',
		'slug',
		'created_at',
		'updated_at'
	];

	public $dates = [
		'created_at',
		'updated_at'
	];

	public $allowedFilters = [
		'title',
		'created_at',
		'updated_at'
	];

	public $allowedSorts = [
		'title',
		'created_at',
		'updated_at'
	];

	//RELATIONSHIPS
	public function meta() {
		return $this->morphMany( Meta::class, 'content' );
	}

}
