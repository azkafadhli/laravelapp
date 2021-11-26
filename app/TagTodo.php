<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TagTodo extends Pivot {
    protected $fillable = ['todo_id', 'tag_id'];

    public function todo() {
        return $this->belongsTo('App\Todo', 'todo_id', 'id');
    }
    public function tag() {
        return $this->belongsTo('App\Tag', 'tag_id', 'id');
    }
}
