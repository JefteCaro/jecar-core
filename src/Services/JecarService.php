<?php

namespace Jecar\Core\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Jecar\Core\Controllers\MediaFilesController;
use Jecar\Core\Models\MediaFile;
use League\Glide\ServerFactory;
use League\Glide\Responses\LaravelResponseFactory;
use TusPhp\Tus\Server as TusServer;

class JecarService
{

    private $config;

    public function __construct()
    {
        $this->config = Config::get('jecar', require($this->resourcePath('config/jecar.php')));
    }

    protected function resourcePath(string $res)
    {
        return __DIR__ . '../../../resources/' . $res;
    }
}
