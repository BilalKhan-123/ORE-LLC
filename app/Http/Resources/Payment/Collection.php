<?php

namespace App\Http\Resources\Payment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
{
    protected $model = 'App\Http\Resources\Payment\Resource';

    public function toArray(Request $request)
    {
        return $this->collection;
    }
}
