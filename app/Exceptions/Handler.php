<?php


namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Debug\Exception\FatalErrorException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,

    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {


        /*if($e instanceof HttpException){
            echo "here";
        }*/

       /* if($request->is('api/*');){
            return $this->renderRestException($request, $e);
        }*/

        if($request->is('api/*') && $e instanceof \Illuminate\Auth\AuthenticationException){
            return response()->json(['success' => false,'message'=>'Invalid user or invalid token'], 401);
        }
        else if($e instanceof MethodNotAllowedHttpException){
            return response()->json(['success' => false,'message'=>'This Method is not allowed for the requested route'], 405);
        }
        else if ($e instanceof \InvalidArgumentException) {
           return \Response::view('errors.404',array(),404);
            //return $e->getResponse();
        }
        else if($e instanceof FatalErrorException){
          return \Response::view('errors.fatal',array('message'=>$e->getMessage(),'fileName'=>$e->getFile()));
        }


        /*else if($e instanceof \Symfony\Component\Debug\Exception\FatalErrorException){
            return response()->json(['success' => false,'message'=>'Internal server error occured. please contact to administrator'], 500);
        }*/
        /*if ($this->isHttpException($e)) {
            switch ($e->getStatusCode()) {
                // not authorized
                case '403':
                    return \Response::view('errors.403',array(),403);
                    break;

                // not found
                case '404':
                    echo "404";
                    //return \Response::view('errors.404',array(),404);
                    break;

                // internal error
                case '500':
                    return \Response::view('errors.500',array(),500);
                    break;

                default:
                    echo "default";
                    //return $this->renderHttpException($e);
                    break;
            }
        } else {
            //echo "else";
            return parent::render($request, $e);
        }*/

        return parent::render($request, $e);

    }

    /*public function renderRestException(Request $request, Exception $e)
    {
        switch($e)
        {
            case ($e instanceof \Illuminate\Auth\AuthenticationException):
                return response()->json(['success' => false,'message'=>'Invalid user or invalid token'], 401);

            default :
                return response()->json(['success' => false,'message'=>$e->getMessage()], $e->getStatusCode());
        }
    }*/

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
