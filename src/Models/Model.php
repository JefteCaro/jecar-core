<?php

namespace Jecar\Core\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Str;

class Model extends BaseModel
{

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        return $this->table ?? Str::snake(config('jecar.table_prefix') . Str::pluralStudly(class_basename($this)));
    }
}
