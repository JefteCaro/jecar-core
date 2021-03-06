<?php

namespace Jecar\Core\Console\Commands;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class MigrationGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Publishing Migrations');
        $this->publish();
    }

    public function buildContent($name, $stubPath)
    {
        $stub = $this->getStub($stubPath);

        $replace = [
            'DummyMigrationClass' => $this->buildCreateClass($name),
            'DummyTableName' => Str::snake($this->buildTableName($name))
        ];

        $output = str_replace(array_keys($replace), array_values($replace), $stub);

        $this->files->put($this->migrationFilePath($name), $output);
    }

    public function getPrefix(): string {

        return ($this->config['database']['table_prefix']) ?: '';
    }

    public function buildTableName(string $name)
    {
        return $this->getPrefix() . Str::pluralStudly($name);
    }

    public function buildCreateClass(string $name)
    {
        return 'Create' . $this->buildTableName($name) . 'Table';
    }

    public function migrationFilePath(string $name)
    {
        return database_path('migrations/' . date('Y_m_d_His', time()) . '_create_' .  Str::snake($this->buildTableName($name))  . '_table.php');
    }

    public function getStub(string $path)
    {
        return $this->files->get($this->resourcePath($path));
    }

    public function publishing($name)
    {
        $this->info('Publishing '. ucfirst($name).' Migration');
    }
}
