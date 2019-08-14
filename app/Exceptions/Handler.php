<?php

namespace Corp\Exceptions;

use Corp\Http\Controllers\SiteController;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;

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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
//        dd($exception); здесь можем выполнить любые действия по предварительной обработке исключений
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
//        dd($exception->getStatusCode());
        if($this->isHttpException($exception)){
            $statusCode = $exception->getStatusCode();
            switch($statusCode){
                case '404':
                    $obj = new SiteController(new \Corp\Repositories\MenusRepository(new \Corp\Menu));
//                    dd($obj);
                    $navigation = view(env('THEME').'.navigation')->with('menu',$obj->getMenu())->render();
                    Log::alert('Page not found - '.$request->url());

                return response()->view(env('THEME').'.404', ['bar' => 'no', 'title' => 'Страница не найдена', 'navigation'=>$navigation]);

                case '403':
                return redirect('/login');

            }
        }
        return parent::render($request, $exception);
    }
}
