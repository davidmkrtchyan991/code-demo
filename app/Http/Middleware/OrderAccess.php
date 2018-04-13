<?php

namespace App\Http\Middleware;

use App\Order;
use App\Utils\OrderUtils;
use Closure;

class OrderAccess
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
        $orderID = $request->route()->parameter('order') ?: $request->route()->parameter('id');
        if (OrderUtils::userHasAccessToOrder(Order::find($orderID))) {
            return $next($request);
        } else {
            return redirect('home');
        }
    }
}
