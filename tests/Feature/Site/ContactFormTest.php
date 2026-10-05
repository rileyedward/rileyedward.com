<?php

namespace Tests\Feature\Site;

use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<string, string>
     */
    private function validInquiry(): array
    {
        return [
            'name' => 'Pat Owner',
            'email' => 'pat@brooksidebakery.test',
            'business_name' => 'Brookside Bakery',
            'phone' => '816-555-0100',
            'message' => 'We need online ordering for pickup.',
        ];
    }

    public function test_a_valid_inquiry_lands_in_the_inbox_without_sending_mail()
    {
        Mail::fake();
        Notification::fake();

        $this->post(route('contact.store'), $this->validInquiry(), ['User-Agent' => 'TestBrowser/1.0'])
            ->assertRedirect(route('contact.create'));

        $message = ContactMessage::query()->sole();
        $this->assertSame('Pat Owner', $message->name);
        $this->assertSame('Brookside Bakery', $message->business_name);
        $this->assertSame('127.0.0.1', $message->ip_address);
        $this->assertSame('TestBrowser/1.0', $message->user_agent);
        $this->assertNull($message->read_at);

        Mail::assertNothingOutgoing();
        Notification::assertNothingSent();

        $this->get(route('contact.create'))->assertInertia(fn (Assert $page) => $page->where('sent', true));
    }

    public function test_optional_fields_may_be_blank()
    {
        $this->post(route('contact.store'), [...$this->validInquiry(), 'business_name' => '', 'phone' => ''])
            ->assertSessionHasNoErrors();

        $this->assertNull(ContactMessage::query()->sole()->business_name);
    }

    public function test_invalid_input_returns_errors_and_stores_nothing()
    {
        $this->from(route('contact.create'))
            ->post(route('contact.store'), ['name' => '', 'email' => 'not-an-email', 'message' => ''])
            ->assertRedirect(route('contact.create'))
            ->assertSessionHasErrors(['name', 'email', 'message']);

        $this->assertDatabaseCount('contact_messages', 0);
    }

    public function test_honeypot_submissions_look_successful_but_are_discarded()
    {
        $this->post(route('contact.store'), [...$this->validInquiry(), 'website' => 'http://spam.test'])
            ->assertRedirect(route('contact.create'));

        $this->assertDatabaseCount('contact_messages', 0);
    }

    public function test_the_sixth_submission_in_an_hour_from_one_ip_is_rejected()
    {
        foreach (range(1, 5) as $attempt) {
            $this->post(route('contact.store'), $this->validInquiry())->assertRedirect();
        }

        $this->post(route('contact.store'), $this->validInquiry())->assertTooManyRequests();

        $this->assertDatabaseCount('contact_messages', 5);

        $this->travel(61)->minutes();

        $this->post(route('contact.store'), $this->validInquiry())->assertRedirect();
        $this->assertDatabaseCount('contact_messages', 6);
    }
}
