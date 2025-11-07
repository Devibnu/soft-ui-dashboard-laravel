<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     * Expect a menu name as parameter, e.g. check.permission:Users
     */
    public function handle(Request $request, Closure $next, $menu = null)
    {
        $user = Auth::user();

        // If not authenticated, let auth middleware handle it
        if (!$user) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda harus login terlebih dahulu.'
                ], 401);
            }
            return redirect()->route('login');
        }

        // Super Admin bypass only when permissions is null (legacy "full access" marker).
        // If Super Admin has explicit permissions array, respect it so admin can restrict access.
        if (method_exists($user, 'isSuperAdmin') && $user->isSuperAdmin() && is_null($user->permissions)) {
            return $next($request);
        }

        // If no specific menu provided, allow
        if (!$menu) {
            return $next($request);
        }

        // Reload user from database to get fresh permissions
        $user->refresh();
        
        // If permissions is null or user has array of permissions
        $perms = $user->permissions;
        if (is_array($perms) && in_array($menu, $perms)) {
            return $next($request);
        }

        // Not allowed
        \Log::warning('Permission denied', [
            'user' => $user->email,
            'menu' => $menu,
            'permissions' => $perms,
            'is_ajax' => $request->expectsJson() || $request->ajax()
        ]);
        
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki permission untuk mengakses fitur ini. Menu: ' . $menu
            ], 403);
        }
        
        return redirect()->route('adminui.dashboard');
    }
}
