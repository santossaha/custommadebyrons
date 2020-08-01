<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
	use SoftDeletes;

    protected $table = 'testimonials';
	protected $dates = ['deleted_at'];
}
