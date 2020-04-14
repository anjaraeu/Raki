<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['path', 'name', 'downloads', 'slug', 'group_id', 'size', 'checksum', 'mime', 'tus_uuid'];

    public function group() {
        return $this->belongsTo('App\Group');
    }
}
