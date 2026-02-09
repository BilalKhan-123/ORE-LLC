<?php

namespace App\Http\Resources\Answer;

use Illuminate\Http\Request;
use App\Traits\ResourceFilterable;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\Resource as UserResource;

class Resource extends JsonResource
{
    use ResourceFilterable;

    protected $model = 'Answer';

    public function toArray(Request $request)
    {
        $data = $this->fields();
        $data['user'] = new UserResource($this->whenLoaded('user'));

        return $data;
    }
}
