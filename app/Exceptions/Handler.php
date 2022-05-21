<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    public function register()
    {
        $this->renderable( function (NotFoundHttpException $e, $request){
            if($request->is('api/*')){
                return response()->json([
                    'error' => [
                        'message'       => 'Resource not found',
                        'type'          => 'NotFoundHttpException',
                        'code'          => '4405',
                        'link'          => 'example.com/link',
                        'status_code'   => (string)$e->getStatusCode(),
                    ],
                ], 404);
            }
        });
    }
}