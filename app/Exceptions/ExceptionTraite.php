<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

trait ExceptionTraite
{
    public function apiException($request,$e){
        // Handle a 404 Model Not Found Exception
        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'error' => 'model not found!',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        }
        // Handle a 404 General Not Found Exception

        if ($e instanceof NotFoundHttpException) {
            return response()->json([
                'error' => 'not found !',
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);        }

    }


}
