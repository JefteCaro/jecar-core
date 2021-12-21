<?php

namespace Jecar\Core\Services;

use Illuminate\Config\Repository as Config;
use Illuminate\Support\Facades\Route;
use Jecar\Core\Controllers\MediaFilesController;
use Jecar\Core\Models\MediaFile;
use League\Glide\ServerFactory;
use League\Glide\Responses\LaravelResponseFactory;
use TusPhp\Tus\Server as TusServer;

class JecarService
{

    public $config;

    public function __construct()
    {
        $this->config = (new Config)->get('jecar', require($this->resourcePath('config/jecar.php')));
    }

    public function getConfig()
    {
        return $this->config;
    }

    protected function resourcePath(string $res)
    {
        return __DIR__ . '../../../resources/' . $res;
    }

    public function pathPrefix($key)
    {
        if(! isset($this->config['paths'][$key])) {
            return '/' . $key;
        }

        $path = $this->config['paths'][$key];

        if(! str_starts_with($path, '/')) {
            $path = '/' . $path;
        }

        return $path;
    }

    public function getTableName($name)
    {
        return (($this->config['database']['table_prefix']) ?: '') . $name;
    }
}
