<?php

namespace App\Http\Middleware;

use App\Traits\auth\UserRoleCheckerHelper;
use Closure;

class CheckRole
{

    use UserRoleCheckerHelper;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role1, $role2 = null, $role3 = null, $role4 = null)
    {
        $roles = collect([$role1, $role2, $role3, $role4]);

        $hasAccess = collect($roles)->contains(function ($value, $key) use ($request, $next) {
            return $value != null && $this->isAuthPassed($value);
        });

        if ($hasAccess) {
            return $next($request);
        } else {
            return redirect('home');
        }
    }
}
