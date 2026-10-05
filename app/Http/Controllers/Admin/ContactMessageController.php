<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ContactMessageController extends Controller
{
    /**
     * List inbox or archived messages, newest first, with optional search.
     */
    public function index(Request $request): Response
    {
        $tab = $request->query('tab') === 'archived' ? 'archived' : 'inbox';
        $search = $request->string('search')->trim()->toString();

        $messages = ContactMessage::query()
            ->when($tab === 'archived', fn ($query) => $query->archived(), fn ($query) => $query->inInbox())
            ->search($search)
            ->latest()
            ->latest('id')
            ->paginate(25)
            ->withQueryString()
            ->through(fn (ContactMessage $message): array => [
                'id' => $message->id,
                'name' => $message->name,
                'email' => $message->email,
                'businessName' => $message->business_name,
                'excerpt' => str($message->message)->squish()->limit(120)->toString(),
                'isRead' => $message->read_at !== null,
                'receivedAt' => $message->created_at?->toIso8601String(),
            ]);

        return Inertia::render('admin/inbox/Index', [
            'messages' => $messages,
            'tab' => $tab,
            'search' => $search,
            'archivedCount' => ContactMessage::query()->archived()->count(),
        ]);
    }

    /**
     * Show a message and mark it read.
     */
    public function show(ContactMessage $message): Response
    {
        if ($message->read_at === null) {
            $message->forceFill(['read_at' => now()])->save();
        }

        return Inertia::render('admin/inbox/Show', [
            'message' => [
                'id' => $message->id,
                'name' => $message->name,
                'email' => $message->email,
                'businessName' => $message->business_name,
                'phone' => $message->phone,
                'message' => $message->message,
                'ipAddress' => $message->ip_address,
                'userAgent' => $message->user_agent,
                'receivedAt' => $message->created_at?->toIso8601String(),
                'isArchived' => $message->archived_at !== null,
            ],
        ]);
    }

    public function markUnread(ContactMessage $message): RedirectResponse
    {
        $message->forceFill(['read_at' => null])->save();

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Marked as unread.']);

        return to_route('inbox.index');
    }

    public function archive(ContactMessage $message): RedirectResponse
    {
        $message->forceFill(['archived_at' => now()])->save();

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Message archived.']);

        return to_route('inbox.index');
    }

    public function unarchive(ContactMessage $message): RedirectResponse
    {
        $message->forceFill(['archived_at' => null])->save();

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Message moved back to the inbox.']);

        return to_route('inbox.index', ['tab' => 'archived']);
    }

    public function destroy(ContactMessage $message): RedirectResponse
    {
        $wasArchived = $message->archived_at !== null;
        $message->delete();

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Message deleted.']);

        return to_route('inbox.index', $wasArchived ? ['tab' => 'archived'] : []);
    }
}
