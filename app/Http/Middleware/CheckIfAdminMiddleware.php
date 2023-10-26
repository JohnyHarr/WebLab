<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfAdminMiddleware
{
    private $roleRoutes = [
        'user' => ['user.'],
        'editor' => ['editor.', 'user.'],
        'admin' => ['admin.', 'editor.', 'user.']
    ];

    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            $role = $user->role;
            $routeName = $request->route()->getName();

            foreach ($this->roleRoutes[$role] as $prefix) {
                if (str_starts_with($routeName, $prefix)) {
                    return $next($request);
                }
            }
        }

        return redirect()->route('home');
    }
}