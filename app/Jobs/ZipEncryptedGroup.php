<?php

namespace App\Jobs;

use Cache;
use Storage;
use App\Group;
use PhpZip\ZipFile;
use App\Helpers\CryptUtil;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ZipEncryptedGroup implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $group;

    private $password;

    /**
     * Create a new job instance.
     *
     * @param Group $group
     * @return void
     */
    public function __construct(Group $group, $password)
    {
        $this->group = $group;
        $this->password = $password;
        Cache::put('job-group-'.$group->id, true);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $crypt = CryptUtil::getEncrypter($this->password);
        $zip = new ZipFile();
        foreach ($this->group->files as $file) {
            $content = Storage::get($file->path);
            $decrypt = $crypt->decrypt($content);
            $zip->addFromString($file->name, $decrypt);
        }
        $zip->setCompressionLevel(2);
        $zip->setPassword($this->password);
        $zip->saveAsFile(storage_path('app/zips/'.$this->group->slug.'.zip'));
        $zip->close();
        Cache::forget('job-group-'.$this->group->id);
        return true;
    }
}
