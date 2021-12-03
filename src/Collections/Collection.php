<?php

namespace Jecar\Core\Collections;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'current_page' => $this->currentPage(),
            'data' => $this->collection,
            'first_page_url' => $this->url(1),
            'from' => $this->firstItem(),
            'links' => [
                [
                    'rel' => 'prev',
                    'url' => $this->previousPageUrl(),
                    'label' => '&laquo; Previous',
                    'active' =>  $this->previousPageUrl() != null,
                ],
                [
                    'rel' => 'current',
                    'url' => $this->url($this->currentPage()),
                    'label' => $this->currentPage(),
                    'active' => true,
                ],
                [
                    'rel' => 'next',
                    'url' => $this->nextPageUrl(),
                    'label' => 'Next &raquo;',
                    'active' => $this->nextPageUrl() != null,
                ],
            ],
            'last_page' => $this->lastPage(),
            'last_page_url' => $this->url($this->lastPage()),
            'next_page_url' => $this->nextPageUrl(),
            'path' => $this->url(0),
            'per_page' => $this->perPage(),
            'prev_page_url' => $this->previousPageUrl(),
            'to' => $this->lastItem(),
            'total' => $this->total(),
        ];
    }
}
