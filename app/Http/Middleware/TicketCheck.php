<?php

namespace App\Http\Middleware;

use Closure;
use Kordy\Ticketit\Models\Ticket;
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
        if(Auth::user()) define('TICKETS', Ticket::where('status_id', 4)->where('user_id', Auth::user()->id)->count());
        return $next($request);
    }
}
