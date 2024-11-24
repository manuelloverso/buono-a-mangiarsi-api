<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
{
    private int $status_code;
    private string $error_message;

    public function __construct(int $status_code, string $error_message = 'Something went wrong')
    {
        $this->status_code = $status_code;
        $this->error_message = $error_message;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success' => false,
            'message' => $this->error_message,
            'status' => $this->status_code
        ];
        //return parent::toArray($request);
    }
}
