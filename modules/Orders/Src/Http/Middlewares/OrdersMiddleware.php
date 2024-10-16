<?php
namespace Modules\Orders\Src\Http\Middlewares;

use Illuminate\Http\Request;
use Closure;
class OrdersMiddleware {
    public  function  handle(Request $request, Closure $next) {
        echo 'middleware' . '<br>';

        return $next($request);
    }
}
