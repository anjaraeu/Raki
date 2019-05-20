<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    protected $fillable = ['link', 'group_id'];

    public function group() {
        return $this->belongsTo('App\Group');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'short_links';
}
