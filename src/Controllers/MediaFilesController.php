<?php

namespace Jecar\Core\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Jecar\Core\Collections\MediaFileCollection;
use League\Glide\Filesystem\FileNotFoundException;
use Jecar\Core\Facades\MediaFile;
use TusPhp\Events\TusEvent;
use Jecar\Core\Models\MediaFile as Files;

class MediaFilesController extends BaseController
{

    public function show(Request $request, $path)
    {
        $filePath = $this->uploadsDirectory() . '/' . $path;

        if(!str_contains(mime_content_type($filePath), 'image'))
        {
            return response()->file($filePath);
        }

        $server = MediaFile::fileServer();

        try {
            return $server->getImageResponse($path, $_GET);

        } catch (FileNotFoundException $e) {
            abort(404);
        } catch (\Exception $e) {
            abort(500, $e->getMessage());
        }
    }

    public function index(Request $request)
    {
        $files = Files::paginate(50);

        return response()->json(new MediaFileCollection($files));
    }

    public function upload(Request $request)
    {
        $server = MediaFile::uploadServer();

        $server->event()->addListener('tus-server.upload.complete', function(TusEvent $event) {

            $file = $event->getFile();

            MediaFile::create($file);
        });

        return $server->serve();
    }

    public function uploadsDirectory()
    {
        return app('jecar')->getConfig()['storage']['uploads'];
    }
}
