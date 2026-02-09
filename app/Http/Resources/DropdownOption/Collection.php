<?php

namespace App\Http\Resources\DropdownOption;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
{
    protected $model = 'App\Http\Resources\DropdownOption\Resource';

    public function toArray(Request $request)
    {
        return $this->collection;
    }
}
