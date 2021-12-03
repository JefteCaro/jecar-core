<?php

namespace Jecar\Core\Collections;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaFileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'alt' => $this->alt,
            'caption' => $this->caption,
            'path' => $this->path,
            'relative_path' => 'uploads/' . $this->path,
            'href' => route('jecar.media.file', ['path' => $this->path]),
            'created_at' => $this->created_at
        ];
    }
}
