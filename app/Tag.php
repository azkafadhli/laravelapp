<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

    public function todo() {
        return $this->belongsToMany(
            'App\Todo',
            'tag_todo',
            'tag_id',
            'todo_id'
        );
    }
    public function account(){
        return $this->hasManyThrough(
            'App\Account', 'App\TagTodo',
            'tag_id', 'uid', 
            'todo_id', 'todo_id'
        );
    }
}
