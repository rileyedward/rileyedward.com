<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Project;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Show inbox and project counts at a glance.
     */
    public function __invoke(): Response
    {
        return Inertia::render('admin/Dashboard', [
            'unreadCount' => ContactMessage::query()->inInbox()->unread()->count(),
            'latestMessages' => ContactMessage::query()
                ->inInbox()
                ->latest()
                ->limit(5)
                ->get(['id', 'name', 'business_name', 'message', 'read_at', 'created_at'])
                ->map(fn (ContactMessage $message): array => [
                    'id' => $message->id,
                    'name' => $message->name,
                    'businessName' => $message->business_name,
                    'excerpt' => str($message->message)->squish()->limit(90)->toString(),
                    'isRead' => $message->read_at !== null,
                    'receivedAt' => $message->created_at?->diffForHumans(),
                ]),
            'visibleProjectCount' => Project::query()->visible()->count(),
            'hiddenProjectCount' => Project::query()->where('is_visible', false)->count(),
        ]);
    }
}
