<?php

namespace Jecar\Core\Collections;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MediaFileCollection extends ResourceCollection
{
    public function __construct($resource)
    {
        $this->collection = MediaFileResource::collection($resource);
        parent::__construct($resource);
    }
}
