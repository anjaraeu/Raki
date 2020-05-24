<?php

namespace App\Console\Commands;

use App\Group;
use Illuminate\Console\Command;

class ClearExpiredGroups extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'raki:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean expired groups (use this to clean space)';

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
        Group::all()->each(function ($group) {
            if ($group->expiry < now()) {
                $this->info($group->name.' is expired, deleting');
                $group->delete();
            }
        });
    }
}
