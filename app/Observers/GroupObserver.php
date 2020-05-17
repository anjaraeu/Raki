<?php

namespace App\Observers;

use App\Group;
use App\Jobs\DeleteFile;
use App\Jobs\DeleteZip;
use Illuminate\Support\Facades\Log;

class GroupObserver
{
    /**
     * Handle the group "updated" event.
     *
     * @param  \App\Group  $group
     * @return void
     */
    public function updated(Group $group)
    {
        if ($group->files->count() === 0) $group->delete();
    }

    /**
     * Handle the group "deleting" event.
     *
     * @param  \App\Group  $group
     * @return void
     */
    public function deleting(Group $group)
    {
        $group->files->each(function($file) {
            DeleteFile::dispatch($file);
        });
        DeleteZip::dispatchNow($group);
    }
}
