<?php

namespace App\Jobs;

use App\Helpers\CryptUtil;
use Illuminate\Support\Facades\Hash;
use App\File;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class EncryptFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;

    /**
     * Create a new job instance.
     *
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Using PBKDF2 to generate a 256bit key derived from client password
        $encrypter = CryptUtil::getEncrypter($this->file->password, true);
        $encrypter->encrypt($this->file->path);
        $this->file->path .= '.enc';
        $this->file->encrypted = true;
        $this->file->password = Hash::make(CryptUtil::getKey($this->file->password, true));
        $this->file->save();
    }
}
