<?php
namespace Modules\Auth\Src\Http\Middlewares;

use Illuminate\Http\Request;
use Closure;
class BlockUserMiddleware {
    public  function  handle(Request $request, Closure $next) {
        $user = $request->user();

        if (!$user->status) {
            return redirect()->route('client.block');
        }
        return $next($request);
    }
}
