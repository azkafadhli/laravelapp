<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model {
    protected $primaryKey = 'id';
    protected $fillable = ['content', 'uid'];

    public function account() {
        return $this->belongsTo('App\Account', 'uid', 'uid')->select(['uid', 'name', 'created_at']);
    }
}
