<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$guard = null)
    {
         if (\Auth::user()->id !== null) {
            return redirect('/');
        }

        return $next($request);

       
    }

    public function render($request, Throwable $e)
    {
        // Show AJAX requests exceptions (for API)
        if ($request->segment(1) == 'api') {
            $json = [
                'success' => false,
                'message' => $e->getMessage(),
                'code'    => $e->getCode(),
            ];
            
            return response()->json($json, 400);
        }

    }
}
