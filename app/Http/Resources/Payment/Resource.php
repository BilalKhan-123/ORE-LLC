<?php

namespace App\Http\Resources\Payment;

use Illuminate\Http\Request;
use App\Traits\ResourceFilterable;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\Resource as UserResource;

class Resource extends JsonResource
{
    use ResourceFilterable;

    protected $model = 'Payment';

    public function toArray(Request $request)
    {
        $data = $this->fields();
        $data['status'] = (empty($data['amount']) && $data['payment_by'] == config('site.roles.admin') ? config('site.exam.type.free') : strtolower($data['status']));
        $data['user'] = new UserResource($this->whenLoaded('user'));

        return $data;
    }
}
