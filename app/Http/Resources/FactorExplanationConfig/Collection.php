<?php

namespace App\Http\Resources\FactorExplanationConfig;

use App\Models\Option;
use App\Models\FactorExplanationConfig;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
{
    protected $model = 'App\Http\Resources\FactorExplanationConfig\Resource';

    public function toArray(Request $request)
    {
        // $factorsResults = FactorExplanationConfig::get();

        // return $factorsResults;
        return $this->collection;
        

        // Here will get the table contents

        return [
           // 'data' => ['questions' => $this->collection, 'options' => $options],
        ];
    }
}
