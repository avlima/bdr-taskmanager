<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model
{
    protected $table = 'todo';

    protected $fillable = [
        'title',
        'description',
        'order'
    ];

    public $timestamps = false;
}
