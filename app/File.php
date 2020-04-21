<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['path', 'name', 'downloads', 'slug', 'group_id', 'size', 'checksum', 'mime', 'tus_uuid'];

    public function group() {
        return $this->belongsTo('App\Group');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
