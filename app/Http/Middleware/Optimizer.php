<?php

namespace App\Http\Middleware;

use App\Traits\auth\UserRoleCheckerHelper;
use Closure;
use App\Classes\enums\RoleEnum;

class Optimizer extends RedirectIfAuthenticated
{

    use UserRoleCheckerHelper;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->isAuthPassed(RoleEnum::ROLE_OPTIMIZER)) {
            return $next($request);
        }

        return redirect('home');
    }
}
