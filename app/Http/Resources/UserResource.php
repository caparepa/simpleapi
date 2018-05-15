<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
{
    private $status;
    private $message;
    private $token;

    public function __construct($resource, $message, $status, $token)
    {
        $this->token = $token;
        $this->status = $status;
        $this->message = $message;
        parent::__construct($resource);
    }


    /**
     * Transform the resource into an array.
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
            'message' => $this->message,
            'token' => $this->token,
        ];
    }

}
