<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    private $code;
    private $status;

    public function __construct($resource, $code, $status)
    {
        parent::__construct($resource);
        $this->code = $code;
        $this->status = $status;
    }


    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function with($request)
    {
        return [
            'status' => $this->status,
            'code' => $this->code,
        ];
    }
}
