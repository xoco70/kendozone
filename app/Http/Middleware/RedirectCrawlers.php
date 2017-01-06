<?php

namespace App\Http\Middleware;

use App\Tournament;
use Closure;
use Illuminate\Support\Facades\Route;

class RedirectCrawlers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $crawlers = [
            'facebookexternalhit/1.1',
            'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)',
            'Facebot',
            'Twitterbot',
        ];

        $userAgent = $request->header('User-Agent');

        if (str_contains($userAgent, $crawlers)) {
            switch (Route::getCurrentRoute()->getPath()) {
                case "tournaments/{tournament}/register":
                    $tournament = Tournament::where('slug', $request->tournament)->first();

                    return view('public/register', compact('tournament'));
            }
        }
        return $next($request);
    }
}
