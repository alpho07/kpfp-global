<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SetTenant
{
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
        $user = auth()->user();

        session([
            'role' => $user->getRoleNames()->toArray(),
            'institution_id' => $user->institution_id
        ]);
    }


        return $next($request);
    }
}
