<?php

namespace App\Traits;

trait ResponseTrait
{
    public const STATUS_ERROR = 'error';
    public const STATUS_SUCCESS = 'success';

    protected function success($message)
    {
        return response([
            'status' => self::STATUS_SUCCESS,
            'message' => $message,
        ]);
    }

    protected function error($message)
    {
        return response([
            'status' => self::STATUS_ERROR,
            'message' => $message,
        ]);
    }
}
