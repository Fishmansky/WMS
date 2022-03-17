<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
	use HasFactory;
	
	protected $table = 'workers';
    	public $timestamps = true;
    	protected $fillable = ['name','surname','login','is_available'];

}
