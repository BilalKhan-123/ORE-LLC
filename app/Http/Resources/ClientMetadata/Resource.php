<?php

namespace App\Http\Resources\ClientMetadata;

use Illuminate\Http\Request;
use App\Traits\ResourceFilterable;
use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
{
    use ResourceFilterable;

    protected $model = 'ClientMetadata';

    public function toArray(Request $request)
    {
        $data = $this->fields();
        $data['remaining_cci_count'] = $this->remaining_cci_count;
        $data['remaining_cci_glycan_count'] = $this->remaining_cci_glycan_count;
        $data['remaining_cci_plus_count'] = $this->remaining_cci_plus_count;
        $data['remaining_cci_consultation_count'] = $this->remaining_cci_consultation_count;

        return $data;
    }
}
