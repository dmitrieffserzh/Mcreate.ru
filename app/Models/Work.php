<?php

namespace App\Models;

use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
	use HasFactory;
	use AsSource;
	use Filterable;

    public $table = 'works';

	public $fillable = [
		'published',
		'title',
		'content',
		'img_cover',
		'img_main',
		'slug',
		'url',
		'work',
		'results',
        'testimonial_id',
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

	protected $allowedSorts = [
		'title',
		'created_at',
		'updated_at'
	];

	// RELATIONSHIPS
	public function testimonials() {
		return $this->hasOne(Testimonial::class, 'id', 'testimonial_id');
	}

	public function meta() {
		return $this->morphMany( Meta::class, 'content' );
	}
}
