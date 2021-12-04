<?php

namespace Jecar\Core\Console\Commands;

use Jecar\Core\Console\Commands\Command;

class PublishViews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jecar:views';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publishes CMS views';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->createOutputDir();
        $this->publish();
    }

    public function publish()
    {
        $this->buildContent($this->outputStub(), 'views/' . $this->outputStub());
    }

    public function buildContent($name, $stubPath)
    {
        $stub = $this->getStub($stubPath);

        if(!file_exists($this->outputDir($name))) {

            $this->info('Publishing view');
            $this->files->put($this->outputDir($name), $stub);
            $this->info('View published');

        } else {
            $this->error('View already exists');
        }
    }

    public function outputStub()
    {
        return 'app.blade.php';
    }

    public function createOutputDir()
    {
        if(!is_dir($this->outputDir())) {
            mkdir(resource_path('views/vendor/jecar'), 0777, true);
        }
    }

    public function outputDir($path = '')
    {
        return resource_path('views/vendor/jecar/' . $path);
    }

}
