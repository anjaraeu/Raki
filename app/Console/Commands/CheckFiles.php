<?php

namespace App\Console\Commands;

use App\File;
use Illuminate\Console\Command;
use Storage;

class CheckFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'raki:scan
        {--delete : Delete orphan files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find orphan files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $files = Storage::files('files');
        $this->comment('Finding orphan files...');
        foreach ($files as $file) {
            if ($file === 'files/.gitignore') {
                // well no...
                continue;
            }
            if (!File::where('path', $file)->exists()) {
                $this->comment($file.' not found in database');
                if ($this->option('delete')) {
                    $this->info('Deleting...');
                    Storage::delete($file);
                }
            }
        }
        return 0;
    }
}
