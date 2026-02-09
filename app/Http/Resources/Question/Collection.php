<?php

namespace App\Http\Resources\Question;

use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
{
    protected $model = 'App\Http\Resources\Question\Resource';

    public function toArray(Request $request)
    {
        $options = Option::get();

        return [
            'data' => ['questions' => $this->collection, 'options' => $options],
        ];
    }
}
