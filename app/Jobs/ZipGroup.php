<?php

namespace App\Jobs;

use Storage;
use App\Group;
use ZipArchive;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ZipGroup implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $group;

    /**
     * Create a new job instance.
     *
     * @param Group $group
     * @return void
     */
    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $zip = new ZipArchive;
        if ($zip->open(storage_path('app/zips/'.$this->group->slug.'.zip'), ZipArchive::CREATE)) {
            foreach ($this->group->files as $file) {
                $zip->addFromString($file->name, Storage::get($file->path));
                $zip->setCompressionName($file->name, ZipArchive::CM_STORE);
            }
            $zip->close();
            return true;
        } else {
            throw new Error('Cannot create zip file.');
            return false;
        }
    }
}
