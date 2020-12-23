<?php

namespace App\Exceptions;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    use ResponseTrait;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
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


    public function render($request, Throwable $e)
    {
        if ($request->wantsJson()) {
            if ($e instanceof \Illuminate\Auth\AuthenticationException) {
                return $this->failed([], 'Unauthorized', 401);
            } else if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return $this->failed([], 'Data tidak ditemukan');
            } else if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                return $this->failed([], 'Path Not Found / Deprecated');
            } else if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return $this->failed([], 'Data tidak ditemukan.');
            } else if ($e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
                return $this->failed([], 'MethodNotAllowedHttpException.', 200);
            } else if ($e instanceof \Illuminate\Validation\ValidationException) {
                $errors = $e->errors();
                return $this->buildFailedValidationResponse($errors);
            }
        }

        return parent::render($request, $e);
    }

    // Custom Failed Validation from Validator
    protected function buildFailedValidationResponse(array $errors)
    {

        $message = '';
        foreach ($errors as $key => $value) {
            foreach ($value as $k => $v) {
                if (!is_string($v)) continue;
                if ($k == 0) $message = $message . $v;
                else $message = $message .  ' | ' . $v;
            }
        }
        // de('asd');
        return $this->failed($errors, $message);
    }
}
