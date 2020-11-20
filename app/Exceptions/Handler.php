<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
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
        //
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $e
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        // Show AJAX requests exceptions (for API)
        if ($request->segment(1) == 'api') {
            $json = [
                'status' => '404',
                'message' => $e->getMessage(),
                'code'    => $e->getCode(),
            ];
            
            return response()->json($json, 400);
        }

       if ($this->isHttpException($e)) {
            return $this->renderHttpException($e);
        } else {
            return parent::render($request, $e);
        }
    }

   
    

   
}
