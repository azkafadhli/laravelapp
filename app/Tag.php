<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {
    protected $table = 'tags';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

    public function post() {
        return $this->belongsToMany('App\Post', 'tag_todo', 'tag_id', 'todo_id');
    }
}
