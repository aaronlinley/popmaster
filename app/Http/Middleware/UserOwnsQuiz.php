<?php

namespace App\Http\Middleware;

use Closure;

use App\Quiz;

class UserOwnsQuiz
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( $request && $request->quiz ) {
            if ( $request->quiz->user_id !== $request->user()->id ) {
                return redirect('/');
            }
        }
        return $next($request);
    }
}
