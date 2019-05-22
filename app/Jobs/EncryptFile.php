<?php

namespace App\Jobs;

use Storage;
use App\File;
use LaravelAEAD\Encrypter;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class EncryptFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;

    private $password;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(File $file, $password)
    {
        $this->file = $file;
        $this->password = hash('sha256', $password);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Using PBKDF2 to generate a 256bit key derivated from client password
        $this->encrypter = new Encrypter(hash_pbkdf2('sha256', $this->password, env('APP_KEY'), 25, 32, true));
        $content = Storage::get($this->file->path);
        $encrypted = $this->encrypter->encrypt($content);
        Storage::delete($this->file->path);
        Storage::put($this->file->path, $encrypted);
        $this->file->encrypted = true;
        $this->file->save();
    }
}
