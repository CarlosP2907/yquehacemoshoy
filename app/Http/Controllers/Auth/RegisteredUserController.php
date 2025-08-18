<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $userType = $request->input('user_type', 'user');
        
        // Debug agresivo
        \Log::info('Registration attempt', [
            'user_type' => $userType,
            'email' => $request->input('email'),
            'all_inputs' => $request->all()
        ]);
        
        // Forzar la creación para debug
        if ($userType === 'company') {
            \Log::info('Going to storeCompany method');
            return $this->storeCompany($request);
        } else {
            \Log::info('Going to storeUser method because user_type = ' . $userType);
            return $this->storeUser($request);
        }
    }

    /**
     * Store a regular user
     */
    private function storeUser(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users', 'unique:companies'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'location' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'free',
            'location' => $request->location ?? '',
            'phone' => $request->phone,
            'email_verified_at' => now(), // Auto-verify for MVP
        ]);

        // Assign user role
        $user->assignRole('user');

        // Create free plan subscription
        $freePlan = Plan::where('type', 'user')->where('name', 'Usuario Gratuito')->first();
        if ($freePlan) {
            Subscription::create([
                'user_id' => $user->id,
                'plan_id' => $freePlan->id,
                'start_date' => now(),
                'status' => 'active',
            ]);
        }

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    /**
     * Store a company
     */
    private function storeCompany(Request $request): RedirectResponse
    {
        \Log::info('In storeCompany method');
        
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:companies', 'unique:users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'company_location' => ['nullable', 'string', 'max:255'],
                'company_phone' => ['nullable', 'string', 'max:20'],
                'website' => ['nullable', 'url', 'max:255'],
                'description' => ['nullable', 'string', 'max:1000'],
            ]);
            
            \Log::info('Company validation passed');
        } catch (\Exception $e) {
            \Log::error('Company validation failed', ['error' => $e->getMessage()]);
            throw $e;
        }

        $company = Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'plan' => 'free',
            'location' => $request->company_location,
            'phone' => $request->company_phone,
            'website' => $request->website,
            'description' => $request->description,
            'verified' => false,
            'email_verified_at' => now(), // Auto-verify for MVP
        ]);

        \Log::info('Company created', ['company_id' => $company->id, 'company_email' => $company->email]);

        // Assign company role
        $company->assignRole('company');

        // Create free plan subscription
        $freePlan = Plan::where('type', 'company')->where('name', 'Empresa Gratuito')->first();
        if ($freePlan) {
            Subscription::create([
                'company_id' => $company->id,
                'plan_id' => $freePlan->id,
                'start_date' => now(),
                'status' => 'active',
            ]);
        }

        event(new Registered($company));
        Auth::guard('company')->login($company);
        
        \Log::info('Company logged in, redirecting to company-dashboard');

        // Redirección forzada con URL completa
        return redirect()->to('/company-dashboard');
    }
}
