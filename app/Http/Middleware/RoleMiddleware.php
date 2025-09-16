<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role;

        // Admin selalu bisa
        if ($userRole === 'admin') {
            return $next($request);
        }

        // Cek role lain
        if (! empty($roles) && in_array($userRole, $roles)) {
            return $next($request);
        }

        abort(403, 'Anda tidak punya akses ke halaman ini.');
    }
}