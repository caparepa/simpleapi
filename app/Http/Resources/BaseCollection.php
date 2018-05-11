<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseCollection extends ResourceCollection
{
    private $code;
    private $status;
    private $message;

    public function __construct($resource, $code, $status, $message)
    {
        parent::__construct($resource);
        $this->code = $code;
        $this->status = $status;
        $this->message = $message;
    }

    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function with($request)
    {
        return [
            'status' => $this->status,
            'code' => $this->code,
            'message' => $this->message,
        ];
    }
}
