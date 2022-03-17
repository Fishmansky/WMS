<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    public $timestamps = true;
    protected $fillable = ['type','location_id','destination_id','item_id','qty','status','finished_at','assigned_to'];
}
