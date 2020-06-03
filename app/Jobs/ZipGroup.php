<?php

namespace App\Jobs;

use Cache;
use Storage;
use App\Group;
use PhpZip\ZipFile;
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
        Cache::put('job-group-'.$group->id, true);
    }

    /**
     * Execute the job.
     *
     * @return bool
     * @throws \PhpZip\Exception\ZipException
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $zip = new ZipFile();
        foreach ($this->group->files as $file) {
            $zip->addFromString($file->name, Storage::get($file->path));
        }
        $zip->setCompressionLevel(2);
        $zip->saveAsFile(storage_path('app/zips/'.$this->group->slug.'.zip'));
        $zip->close();
        Cache::forget('job-group-'.$this->group->id);
        return true;
    }
}
