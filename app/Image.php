<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $guarded = [];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'task_id');

    }
}
