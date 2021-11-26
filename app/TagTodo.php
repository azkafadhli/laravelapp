<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagTodo extends Model {
    protected $table = 'tag_todo';
    protected $fillable = ['todo_id', 'tag_id'];
}
