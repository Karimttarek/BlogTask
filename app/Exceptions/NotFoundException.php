<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($this->isHttpException($exception)) {
            if ($exception->getStatusCode() == 404) {

                return response()->view('errors.404');
            }
        }

        return parent::render($request, $exception);
    }
}
