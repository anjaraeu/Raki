<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['slug', 'name', 'downloads', 'expiry'];

    public function files() {
        return $this->hasMany('App\File');
    }
}
