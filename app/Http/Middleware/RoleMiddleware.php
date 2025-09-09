<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (! Auth::check()) {
            return redirect('/login');
        }

        $userRole = Auth::user()->role;

        // ✅ Kalau admin, full akses (tanpa cek roles)
        if ($userRole === 'admin') {
            return $next($request);
        }

        // ✅ Kalau role user sesuai dengan yang diminta
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // ❌ Kalau tidak sesuai, forbidden
        abort(403, 'Anda tidak punya akses ke halaman ini.');
    }
}