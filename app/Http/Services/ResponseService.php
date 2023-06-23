<?php 

namespace App\Http\Services;

trait ResponseService {
    
    public function response($status,$payload,$message = '')
    {
        return [
            'status'  => $status,
            'payload' => $payload,
            'message' => $message
        ];
    }

}