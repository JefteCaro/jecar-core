<?php

namespace Jecar\Core\Models;

use Illuminate\Support\Str;

class MediaFile extends Model
{

    protected $fillable = [
        'name',
        'alt',
        'caption',
        'path',
    ];

    public function generateSlugFile()
    {
        $slug = Str::slug(pathinfo($this->name, PATHINFO_FILENAME)) . '.' . pathinfo($this->name, PATHINFO_EXTENSION);

        $path = $this->uploadsDirectory() . DIRECTORY_SEPARATOR . $slug;

        if(!file_exists($this->uploadsDirectory() . DIRECTORY_SEPARATOR . $this->path) && file_exists($path)) {
            $this->path = $slug;
            $this->save();
        }

        if(!file_exists($path))
        {
            rename($this->uploadsDirectory() . DIRECTORY_SEPARATOR . $this->path, $path);
            $this->path = $slug;
            $this->name = $slug;
            $this->save();
        }

    }

    public function getThumbnail()
    {
        $path = $this->uploadsDirectory() . DIRECTORY_SEPARATOR . $this->path;

        if(!str_contains(mime_content_type($path), 'image'))
        {
            return "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='400' viewBox='0 0 400 400'%3E%3Crect fill='%23ddd' width='400' height='400'/%3E%3Ctext fill='rgba(0,0,0,0.5)' font-family='sans-serif' font-size='50' dy='10.5' font-weight='bold' x='50%25' y='50%25' text-anchor='middle'%3EFile%3C/text%3E%3C/svg%3E%0A";
        }
        return route('jecar.media.file', ['path' => $this->path, 'w' => 400, 'h' => 400, 'fit' => 'crop']);
    }

    public function uploadsDirectory()
    {
        return app('jecar')->getConfig()['storage']['uploads'];
    }

    public static function booted()
    {
        static::retrieved(function($data) {
            $data->generateSlugFile();
        });
    }
}
