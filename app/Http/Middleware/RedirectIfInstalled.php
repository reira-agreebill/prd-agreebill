<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\File;

class RedirectIfInstalled
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
        $installFile = File::exists(base_path('install'));
        if (!$installFile) {
            return redirect()->route('dashboard');
        }
        return $next($request);
    }

}
