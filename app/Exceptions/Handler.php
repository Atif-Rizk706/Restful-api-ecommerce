<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request, Throwable $exception)
    {
        // Handle a 404 Not Found Exception
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'error' => 'model not found!',
                'message' => $exception->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        }

        // Handle an Authentication Exception
        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'error' => 'not found !',
                'message' => $exception->getMessage(),
            ], Response::HTTP_NOT_FOUND);        }

        // Default exception handling
        return parent::render($request, $exception);
    }
}
