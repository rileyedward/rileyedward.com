<?php

namespace Database\Factories;

use App\Models\ContactMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ContactMessage>
 */
class ContactMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'business_name' => fake()->optional()->company(),
            'phone' => fake()->optional()->phoneNumber(),
            'message' => fake()->paragraph(),
            'read_at' => null,
            'archived_at' => null,
            'ip_address' => fake()->ipv4(),
            'user_agent' => fake()->userAgent(),
        ];
    }

    /**
     * A message that has been opened.
     */
    public function read(): static
    {
        return $this->state(fn (): array => ['read_at' => now()]);
    }

    /**
     * A message moved out of the inbox.
     */
    public function archived(): static
    {
        return $this->state(fn (): array => ['archived_at' => now()]);
    }
}
