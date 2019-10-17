<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected function likable();

    public function likable()
    {
        return $this->morphTo();
    }
}
