<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoorStatus extends Model
{
    protected $fillable = ['status'];
    public $timestamps = false;
}
