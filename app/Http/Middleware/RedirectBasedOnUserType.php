<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class RedirectBasedOnUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            \Log::info('Middleware RedirectBasedOnUserType', [
                'user_type' => get_class($user),
                'user_id' => $user->id,
                'current_route' => $request->route()?->getName(),
                'url' => $request->url()
            ]);
            
            // Verificar si es una empresa (Company model)
            if ($user instanceof Company) {
                \Log::info('User is Company, checking routes');
                // Si está intentando acceder a rutas de usuario, redirigir a empresa
                if ($request->routeIs('freeUser-template') || $request->routeIs('dashboard')) {
                    \Log::info('Redirecting company to company-dashboard');
                    return redirect()->route('company-dashboard');
                }
            } 
            // Verificar si es un usuario regular (User model)
            else if ($user instanceof User) {
                \Log::info('User is regular User, checking routes');
                // Si está intentando acceder a rutas de empresa, redirigir a usuario
                if ($request->routeIs('company-template') || $request->routeIs('company-dashboard')) {
                    \Log::info('Redirecting user to freeUser-template');
                    return redirect()->route('freeUser-template');
                }
            }
        }

        return $next($request);
    }
}
