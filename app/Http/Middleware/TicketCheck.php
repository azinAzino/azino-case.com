<?php

namespace App\Http\Middleware;

use Closure;
use App\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketCheck
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
        if(Auth::user()) define('TICKETS', Ticket::where('status', 'new')->where('user_id', Auth::user()->id)->count());
        return $next($request);
    }
}