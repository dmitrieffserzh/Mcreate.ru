<?php

namespace App\Models;

use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
	use AsSource;
	use Filterable;

	public $fillable = [
		'name',
		'phone',
		'message',
		'agreement',
		'type',
		'utm_source',
		'ip',
		'user_agent',
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
}
