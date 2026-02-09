<?php

namespace App\Http\Resources\DropdownOption;

use Illuminate\Http\Request;
use App\Traits\ResourceFilterable;
use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
{
    use ResourceFilterable;

    protected $model = 'DropdownOption';

    public function toArray(Request $request): array
    {
        $data = $this->fields();

        return $data;
    }
}
