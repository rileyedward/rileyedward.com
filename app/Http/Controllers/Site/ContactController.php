<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Inertia\Inertia;
use Inertia\Response;

class ContactController extends Controller
{
    /**
     * Show the inquiry form.
     */
    public function create(): Response
    {
        return Inertia::render('public/Contact', [
            'sent' => session('contact.sent', false),
        ]);
    }

    /**
     * Store an inquiry in the admin inbox. No email is sent.
     */
    public function store(StoreContactMessageRequest $request): RedirectResponse
    {
        if (! $request->isSpam()) {
            ContactMessage::query()->create([
                ...Arr::except($request->validated(), ['website']),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        return to_route('contact.create')->with('contact.sent', true);
    }
}
