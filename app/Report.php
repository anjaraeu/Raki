<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['group_id', 'reason', 'processed'];

    protected $casts = [
        'processed' => 'bool'
    ];

    public function process() {
        $this->processed = true;
        return $this;
    }
}
