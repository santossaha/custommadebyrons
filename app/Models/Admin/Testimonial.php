<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Testimonial extends Model
{
	use SoftDeletes;
   protected $table = 'testimonials';
   protected $fillable = ['id','image','name','status','description','designation','created_at','updated_at','deleted_at'];
   protected $visible = ['id','image','name','status','description','designation','created_at','updated_at','deleted_at'];
   protected $dates = ['deleted_at'];
   public $timestamps = true;
}
