<?php

namespace App\Jobs;

use Storage;
use App\Group;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DeleteZip implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $group;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Group $group)
    {
        $this->group = $group->withoutRelations();
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        $this->group->delete();
        return Storage::delete('zips/'.$this->group->slug.'.zip');
    }
}
