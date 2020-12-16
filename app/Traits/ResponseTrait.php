<?php

namespace App\Traits;

trait ResponseTrait
{
    public function success($data = [], $message = 'success')
    {
        return response()->json([
            'status'    => true,
            'data'      => $data,
            'message'   => $message
        ]);
    }

    public function failed($data = [], $message = 'failed')
    {
        return response()->json([
            'status'    => false,
            'data'      => $data,
            'message'   => $message
        ]);
    }
}
