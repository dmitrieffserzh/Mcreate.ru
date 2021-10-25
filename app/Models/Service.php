<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

	public $fillable = [
		'parent_id',
		'title',
		'content',
		'published',
		'created_at',
		'updated_at'
	];

	public $dates = [
		'created_at',
		'updated_at'
	];

	// RELATIONSHIPS
	public function page() {
		return $this->hasOne( Page::class, 'id' );
	}
}
