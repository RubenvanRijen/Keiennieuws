<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
        if ($this->isHttpException($exception)) {
            if ($exception->getStatusCode() == 404) {
                $responseText = 'OOPS, de pagina die u probeert te bereiken bestaat niet of is niet bereikbaar of verplaatst';
                return response()->view('pages/errors.' . '404', ['responseCode' => $exception->getStatusCode(), 'responseText2' => $responseText], 404);   //errors is a folder inside views
            } elseif ($exception->getStatusCode() == 401) {
                $responseText = 'OOPS, U heeft geen toegang of moet inloggen';
                return response()->view('pages/errors.' . '401', ['responseCode' => $exception->getStatusCode(), 'responseText2' => $responseText], 401);   //errors is a folder inside views
            } elseif ($exception->getStatusCode() == 403) {
                $responseText = 'OOPS, U heeft geen toegang';
                return response()->view('pages/errors.' . '403', ['responseCode' => $exception->getStatusCode(), 'responseText2' => $responseText], 403);   //errors is a folder inside views
            } elseif ($exception->getStatusCode() == 419) {
                $responseText = 'OOPS, Pagina/Sessie verlopen, log opnieuw in';
                return response()->view('pages/errors.' . '419', ['responseCode' => $exception->getStatusCode(), 'responseText2' => $responseText], 419);   //errors is a folder inside views
            } elseif ($exception->getStatusCode() == 429) {
                $responseText = 'OOPS, U heeft te veel aanvragen gedaan';
                return response()->view('pages/errors.' . '429', ['responseCode' => $exception->getStatusCode(), 'responseText2' => $responseText], 429);   //errors is a folder inside views
            } elseif ($exception->getStatusCode() == 500) {
                $responseText = 'OOPS, Server fout';
                return response()->view('pages/errors.' . '500', ['responseCode' => $exception->getStatusCode(), 'responseText2' => $responseText], 500);   //errors is a folder inside views
            } elseif ($exception->getStatusCode() == 503) {
                $responseText = 'OOPS, De server is even niet bereikbaar';
                return response()->view('pages/errors.' . '503', ['responseCode' => $exception->getStatusCode(), 'responseText2' => $responseText], 503);   //errors is a folder inside views
            }
        }
        return parent::render($request, $exception);
    }
}
