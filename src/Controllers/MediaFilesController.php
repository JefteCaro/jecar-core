<?php

namespace Jecar\Core\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use League\Glide\Filesystem\FileNotFoundException;
use Jecar\Core\Facades\MediaFile;

class MediaFilesController extends BaseController
{

    public function show(Request $request, $path)
    {
        $server = MediaFile::fileServer();

        try {
            return $server->getImageResponse($path, $_GET);

        } catch (FileNotFoundException $e) {
            abort(404);
        } catch (\Exception $e) {
            abort(500, $e->getMessage());
        }
    }

    public function upload(Request $request)
    {
        return MediaFile::uploadServer()->serve();
    }
}
