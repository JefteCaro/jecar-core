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

        $path = config('jecar.storage.uploads') . DIRECTORY_SEPARATOR . $slug;

        if(!file_exists(config('jecar.storage.uploads') . DIRECTORY_SEPARATOR . $this->path) && file_exists($path)) {
            $this->path = $slug;
            $this->save();
        }

        if(!file_exists($path))
        {
            rename(config('jecar.storage.uploads') . DIRECTORY_SEPARATOR . $this->path, $path);
            $this->path = $slug;
            $this->name = $slug;
            $this->save();
        }

    }

    public static function booted()
    {
        static::retrieved(function($data) {
            $data->generateSlugFile();
        });
    }
}
