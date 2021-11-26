<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $primaryKey = 'uid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['uid', 'name', 'key', 'secret', 'is_enabled'];

    public function todos() {
        return $this->hasMany('App\Todo', 'uid', 'uid');
    }
}
