<?php

namespace Jecar\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class PublishMigrations extends MigrationGenerator
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jecar:migrations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publishes Core migrations';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function publish()
    {
        $this->publishMediaFile();
    }

    public function publishMediaFile()
    {
        $this->publishing('mediaFile');
        $this->buildContent('mediaFile', 'migrations/media_file.stub');
    }
}
