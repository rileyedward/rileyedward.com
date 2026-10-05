<?php

namespace App\Console\Commands;

use App\Concerns\ProfileValidationRules;
use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

#[Signature('app:create-admin {--name= : The admin\'s display name} {--email= : The admin\'s login email} {--password= : The admin\'s password (prompted when omitted)}')]
#[Description('Create the admin user who can sign in to /admin')]
class CreateAdmin extends Command
{
    use ProfileValidationRules;

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $attributes = [
            'name' => $this->option('name') ?? $this->ask('Name'),
            'email' => $this->option('email') ?? $this->ask('Email'),
            'password' => $this->option('password') ?? $this->secret('Password'),
        ];

        $validator = Validator::make($attributes, [
            ...$this->profileRules(),
            'password' => ['required', 'string', Password::default()],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->components->error($error);
            }

            return self::FAILURE;
        }

        User::query()->forceCreate([
            ...$validator->validated(),
            'email_verified_at' => now(),
        ]);

        $this->components->info("Admin {$attributes['email']} created. Sign in at ".url('/login').'.');

        return self::SUCCESS;
    }
}
