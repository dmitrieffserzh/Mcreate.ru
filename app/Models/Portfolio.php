<?php

namespace App\Models;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;




	// RELATIONSHIPS
	public function parent() {
		return $this->hasOne(Testimonial::class, 'id');
	}
}
