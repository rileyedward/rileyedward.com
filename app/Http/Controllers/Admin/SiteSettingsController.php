<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\SiteSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Inertia\Inertia;
use Inertia\Response;

class SiteSettingsController extends Controller
{
    public function edit(SiteSettings $settings): Response
    {
        return Inertia::render('admin/SiteSettings', [
            'settings' => $settings->all(),
        ]);
    }

    public function update(Request $request, SiteSettings $settings): RedirectResponse
    {
        $validated = $request->validate([
            'availability' => ['nullable', 'string', 'max:120'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'github_url' => ['nullable', 'url:http,https', 'max:255'],
            'linkedin_url' => ['nullable', 'url:http,https', 'max:255'],
            'career_start_year' => ['nullable', 'integer', 'min:1990', 'max:'.Date::now()->year],
        ]);

        $settings->update(array_map(
            fn (mixed $value): ?string => $value === null ? null : (string) $value,
            $validated,
        ));

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Settings saved. The site is updated.']);

        return to_route('site-settings.edit');
    }
}
