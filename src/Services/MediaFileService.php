<?php

namespace Jecar\Core\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Jecar\Core\Controllers\MediaFilesController;
use Jecar\Core\Models\MediaFile;
use League\Glide\ServerFactory;
use League\Glide\Responses\LaravelResponseFactory;
use TusPhp\Tus\Server as TusServer;

class MediaFileService
{

    private $config;

    public function __construct()
    {
        $this->config = Config::get('jecar', require($this->resourcePath('config/jecar.php')));
    }

    public function fileServer()
    {
        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory(app('request')),
            'source' => $this->getUploadsFolder(),
            'cache' => $this->getCacheFolder(),
        ]);

        return $server;
    }

    public function uploadServer()
    {
        $server = new TusServer(($this->config['storage']['driver']) ?: '');

        $server
            ->setApiPath('/upload') // tus server endpoint.
            ->setUploadDir($this->getUploadsFolder()); // uploads dir.
            return $server;
    }

    public function routes()
    {
        Route::group(['as' => 'jecar.'], function() {

            Route::any('/upload/{any?}', [MediaFilesController::class, 'upload'])->name('media.upload')->where('any', '.*');

            Route::get('/uploads', [MediaFilesController::class, 'index'])->name('media');

            Route::get('/uploads/{path}', [MediaFilesController::class, 'show'])->name('media.file');

        });

    }

    public function create($file)
    {
        MediaFile::create([
            'name' => $file->getName(),
            'alt' => $file->getName(),
            'caption',
            'path' => $file->getName(),
        ]);
    }

    private function getUploadsFolder()
    {
        $path = ($this->config['storage']['uploads']) ?: storage_path('app/jecar/uploads');

        $this->createFolder($path);

        return $path;
    }

    private function getCacheFolder()
    {
        $path = ($this->config['storage']['cache']) ?: storage_path('app/jecar/cache');

        $this->createFolder($path);

        return $path;
    }

    private function createFolder($path)
    {
        if(!is_dir($path)) {
            mkdir($path, 0777, true);
        }
    }

    private function resourcePath(string $res)
    {
        return __DIR__ . '../../resources/' . $res;
    }
}
