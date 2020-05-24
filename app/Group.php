<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Group extends Model
{
    protected $fillable = ['slug', 'name', 'downloads', 'expiry', 'passwd'];

    protected $hidden = ['passwd'];

    protected $casts = [
        'expiry' => 'datetime'
    ];

    public function files() {
        return $this->hasMany('App\File');
    }

    public function link() {
        return $this->hasOne('App\ShortLink');
    }

    public function owner() {
        return $this->belongsTo('App\User');
    }

    public function reports() {
        return $this->hasMany('App\Report');
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

    public function getExpiryFormattedAttribute() {
        return $this->expiry->locale(App::getLocale())->isoFormat('LLLL');
    }

}
