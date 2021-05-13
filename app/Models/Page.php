<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Page extends Model
{
    use HasFactory;
	use AsSource;

	public $fillable = [
		'parent_id',
		'title',
		'slug',
		'content',
		'published',
		'created_at',
		'updated_at'
	];

	public $dates = [
		'created_at',
		'updated_at'
	];

	public function getRouteKeyName() {
		return 'slug';
	}

    // RELATIONSHIPS
	public function parent() {
		return $this->belongsTo(self::class, 'parent_id', 'id');
	}
}
