<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\File;

class RedirectIfNoUpdateAvailable
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
        $updateFile = File::exists(base_path('update'));
        if (!$updateFile) {
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}
