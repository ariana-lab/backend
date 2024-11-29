<?php 

use Closure;
use Carbon\Carbon;

class FormatDateMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->has('start_date')) {
            $request->merge([
                'start_date' => Carbon::parse($request->start_date)->format('Y-m-d H:i:s'),
            ]);
        }
        return $next($request);
    }

    
}
