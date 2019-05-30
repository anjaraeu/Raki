<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['slug', 'name', 'downloads', 'expiry', 'passwd'];

    protected $hidden = ['passwd'];

    public function files() {
        return $this->hasMany('App\File');
    }

    public function link() {
        return $this->hasOne('App\ShortLink');
    }
}
