<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class Handler extends ExceptionHandler
{
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            return response()->json([
                'errors' => $exception->errors()
            ], 422);
        }

        if ($exception instanceof \App\Exceptions\InactivityException) {
            return response()->json([
                'error' => 'Inactivity error',
                'message' => $exception->getMessage()
            ], 400);
        }

        return response()->json([
            'error' => 'Server error',
            'message' => $exception->getMessage()
        ], 500);
    }
}
