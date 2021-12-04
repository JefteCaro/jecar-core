<?php

namespace Jecar\Core\Collections;

class MediaFileCollection extends Collection
{
    public function __construct($resource)
    {
        $this->collection = MediaFileResource::collection($resource);
        parent::__construct($resource);
    }
}
