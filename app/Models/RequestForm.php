<?php

namespace App\Models;

use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestForm extends Model
{
    use HasFactory;
	use AsSource;
	use Filterable;

	public $table = 'requests';

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
		'created_at',
		'updated_at'
	];

	protected $allowedSorts = [
		'created_at',
		'updated_at'
	];
}
