<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\CompanyProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Display the company's profile form.
     */
    public function editCompany(Request $request): View
    {
        $company = Auth::guard('company')->user();
        
        return view('profile.edit-company', [
            'company' => $company,
        ]);
    }

    /**
     * Update the company's profile information.
     */
    public function updateCompany(CompanyProfileUpdateRequest $request): RedirectResponse
    {
        $company = Auth::guard('company')->user();
        $company->fill($request->validated());

        if ($company->isDirty('email')) {
            $company->email_verified_at = null;
        }

        $company->save();

        return Redirect::route('company.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the company's account.
     */
    public function destroyCompany(Request $request): RedirectResponse
    {
        $request->validateWithBag('companyDeletion', [
            'password' => ['required', 'current_password:company'],
        ]);

        $company = Auth::guard('company')->user();

        Auth::guard('company')->logout();

        $company->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
