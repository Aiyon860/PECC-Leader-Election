<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vote;

class CheckVoteStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Periksa jika user sudah login
        if (Auth::check()) {
            // Periksa apakah user sudah melakukan voting
            $existingVote = Vote::where('user_id', Auth::id())->first();
            
            if ($existingVote) {
                // Jika user sudah voting dan mencoba mengakses halaman voting
                if ($request->routeIs('vote.index')) {
                    return redirect()->route('vote.thank-you');
                }
            } else {
                // Jika user belum voting dan mencoba mengakses halaman thank-you
                if ($request->routeIs('vote.thank-you')) {
                    return redirect()->route('vote.index')->with('info', 'Anda belum melakukan voting!');
                }
            }
        }

        return $next($request);
    }
}