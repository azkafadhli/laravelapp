<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model {
    protected $table = 'accounts';
    protected $primaryKey = 'uid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['uid', 'name', 'key', 'secret', 'is_enabled'];

    public function todos() {
        return $this->hasMany('App\Todo', 'uid', 'uid');
    }
    public function tags() {
        return $this->hasManyThrough(
            'App\TagTodo', 
            'App\Todo', 
            'uid', 
            'todo_id', 
            'uid', 
            'id'
        );
    }
}
