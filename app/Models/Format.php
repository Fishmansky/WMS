<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    use HasFactory;

    protected $table = 'formats';
    public $timestamps = false;
    protected $fillable = ['format', 'capacity'];
}
