<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visitor;

class LogVisitor
{
    public function handle($request, Closure $next)
    {
        $ipAddress = $request->ip();

        // Check if the IP address has already been logged today
        $existingVisitor = Visitor::where('ip_address', $ipAddress)
                                  ->whereDate('created_at', now()->toDateString())
                                  ->first();

        if (!$existingVisitor) {
            // Store the visitor's IP address
            Visitor::create(['ip_address' => $ipAddress]);
        }

        return $next($request);
    }
}
