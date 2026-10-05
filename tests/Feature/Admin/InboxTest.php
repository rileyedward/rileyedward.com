<?php

namespace Tests\Feature\Admin;

use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class InboxTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    public function test_inbox_lists_unarchived_messages_newest_first()
    {
        $older = ContactMessage::factory()->create(['created_at' => now()->subDay()]);
        $newer = ContactMessage::factory()->read()->create();
        ContactMessage::factory()->archived()->create();

        $this->get(route('inbox.index'))->assertInertia(fn (Assert $page) => $page
            ->component('admin/inbox/Index')
            ->has('messages.data', 2)
            ->where('messages.data.0.id', $newer->id)
            ->where('messages.data.0.isRead', true)
            ->where('messages.data.1.id', $older->id)
            ->where('messages.data.1.isRead', false)
            ->where('archivedCount', 1)
            ->where('unreadMessageCount', 1)
        );
    }

    public function test_archived_tab_lists_only_archived_messages()
    {
        ContactMessage::factory()->create();
        $archived = ContactMessage::factory()->archived()->create();

        $this->get(route('inbox.index', ['tab' => 'archived']))->assertInertia(fn (Assert $page) => $page
            ->has('messages.data', 1)
            ->where('messages.data.0.id', $archived->id)
            ->where('tab', 'archived')
        );
    }

    public function test_search_matches_name_email_business_and_message_case_insensitively()
    {
        $byName = ContactMessage::factory()->create(['name' => 'Jordan Baker']);
        $byEmail = ContactMessage::factory()->create(['email' => 'owner@bakeryco.test']);
        $byBusiness = ContactMessage::factory()->create(['business_name' => 'Brookside BAKERY']);
        $byMessage = ContactMessage::factory()->create(['message' => 'We run a bakery and need ordering.']);
        ContactMessage::factory()->create(['name' => 'Sam', 'email' => 'sam@x.test', 'business_name' => null, 'message' => 'Hello']);

        $this->get(route('inbox.index', ['search' => 'Bake']))->assertInertia(fn (Assert $page) => $page
            ->has('messages.data', 4)
            ->where('messages.data', fn ($messages) => collect($messages)->pluck('id')->sort()->values()->all()
                === collect([$byName, $byEmail, $byBusiness, $byMessage])->pluck('id')->sort()->values()->all())
        );
    }

    public function test_opening_a_message_marks_it_read_and_shows_every_field()
    {
        $message = ContactMessage::factory()->create(['ip_address' => '203.0.113.9', 'phone' => '816-555-0100']);

        $this->get(route('inbox.show', $message))->assertInertia(fn (Assert $page) => $page
            ->component('admin/inbox/Show')
            ->where('message.ipAddress', '203.0.113.9')
            ->where('message.phone', '816-555-0100')
            ->where('message.email', $message->email)
            ->where('message.message', $message->message)
        );

        $this->assertNotNull($message->fresh()->read_at);
    }

    public function test_mark_unread_archive_unarchive_and_delete()
    {
        $message = ContactMessage::factory()->read()->create();

        $this->patch(route('inbox.unread', $message))->assertRedirect(route('inbox.index'));
        $this->assertNull($message->fresh()->read_at);

        $this->patch(route('inbox.archive', $message))->assertRedirect(route('inbox.index'));
        $this->assertNotNull($message->fresh()->archived_at);

        $this->patch(route('inbox.unarchive', $message))->assertRedirect(route('inbox.index', ['tab' => 'archived']));
        $this->assertNull($message->fresh()->archived_at);

        $this->delete(route('inbox.destroy', $message))->assertRedirect(route('inbox.index'));
        $this->assertModelMissing($message);
    }
}
