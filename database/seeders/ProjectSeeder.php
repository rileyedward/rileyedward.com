<?php

namespace Database\Seeders;

use App\Enums\ProjectKind;
use App\Enums\ProjectStatus;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Seed the known projects. Riley fills in the remaining copy in the admin.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Dandelines Design',
                'slug' => 'dandelines-design',
                'kind' => ProjectKind::Client,
                'summary' => 'An event design storefront with a Laravel admin portal and Stripe checkout.',
                'body' => "TODO: Riley to write up the project.\n\n## The problem\n\n## What I built\n\n## Notable details\n",
                'role' => null,
                'stack' => ['Laravel', 'Vue', 'TypeScript', 'Tailwind', 'Stripe'],
                'status' => ProjectStatus::Live,
                'live_url' => 'https://dandelinesdesign.com',
                'is_visible' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Lauren Alexandra',
                'slug' => 'lauren-alexandra',
                'kind' => ProjectKind::Client,
                'summary' => 'TODO: one-line summary.',
                'stack' => ['Laravel', 'Vue'],
                'status' => ProjectStatus::InProgress,
            ],
            [
                'title' => 'Applicy',
                'slug' => 'applicy',
                'kind' => ProjectKind::Personal,
                'summary' => 'A job application tracker with AI help for resumes and cover letters.',
                'body' => <<<'MD'
                    Applicy is a comprehensive online platform that simplifies your job application process. Create a personalized profile to seamlessly track all your job applications and monitor their progress in real time. With Applicy, you can easily organize your job search efforts, making it simpler to stay on top of your applications and secure your next opportunity.

                    ## Features

                    - Keep track of the job applications you have submitted and the status of each one.
                    - Upload and store your resumes and get AI recommendations based on the job you're applying for.
                    - Upload and store your cover letters and have the AI assistant tailor versions for each job.
                    MD,
                'role' => 'Design and full-stack build',
                'stack' => ['Laravel', 'PHP', 'Vue', 'TypeScript', 'Tailwind', 'PostgreSQL'],
                'status' => ProjectStatus::Live,
                'repo_url' => 'https://github.com/rileyedward/applicy',
                'is_visible' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Corvesive',
                'slug' => 'corvesive',
                'kind' => ProjectKind::Personal,
                'summary' => 'A budgeting app for tracking income, monthly expenses and what is left over.',
                'body' => <<<'MD'
                    Corvesive is an online application designed to simplify your budgeting. Track your income by uploading pay stubs, record your monthly expenses, and effortlessly monitor where your money is going and how much you have left. Gain clarity on your financial situation to make better budgeting decisions.

                    ## Features

                    - Upload pay stubs and keep a record of all your income sources.
                    - Record monthly expenses and categorize them for easy tracking.
                    - Visualize where your money is going to make informed budgeting decisions.
                    MD,
                'role' => 'Design and full-stack build',
                'stack' => ['Laravel', 'PHP', 'Vue', 'TypeScript', 'Tailwind', 'MySQL'],
                'status' => ProjectStatus::Live,
                'repo_url' => 'https://github.com/rileyedward/corvesive',
                'is_visible' => true,
            ],
            [
                'title' => 'AirQueue',
                'slug' => 'airqueue',
                'kind' => ProjectKind::Personal,
                'summary' => 'Collaborative Spotify listening sessions with friends.',
                'body' => <<<'MD'
                    AirQueue is a platform designed to enhance your music-sharing experience with friends through interactive Live Sessions. It integrates with the Spotify Developer API to search for songs and interact with each listener's Spotify account.

                    ## Features

                    - Connect your AirQueue account with Spotify.
                    - Join a "band" with other members to gather a group of like-minded music friends.
                    - Host or join a session with friends to search for and request songs together.
                    MD,
                'role' => 'Design and full-stack build',
                'stack' => ['Laravel', 'PHP', 'Vue', 'TypeScript', 'Tailwind', 'MySQL'],
                'status' => ProjectStatus::Live,
                'repo_url' => 'https://github.com/rileyedward/airqueue',
                'is_visible' => true,
            ],
            [
                'title' => 'Poker hand analysis tool',
                'slug' => 'poker-hand-analysis',
                'kind' => ProjectKind::Personal,
                'summary' => 'TODO: name, one-line summary and link.',
                'stack' => [],
                'status' => ProjectStatus::InProgress,
            ],
            [
                'title' => 'Party games site',
                'slug' => 'party-games',
                'kind' => ProjectKind::Personal,
                'summary' => 'TODO: one-line summary. Turn on once a game is playable.',
                'stack' => [],
                'status' => ProjectStatus::InProgress,
            ],
            [
                'title' => 'gip',
                'slug' => 'gip',
                'kind' => ProjectKind::Personal,
                'summary' => 'A CLI for quick work-in-progress commits and squashing them later.',
                'body' => <<<'MD'
                    gip is a lightweight command-line tool designed to streamline work-in-progress (WIP) commits. If you often find yourself juggling micro-commits during development, gip helps you manage them without complicating your Git workflow.

                    ## Features

                    - Quickly commit all the work you currently have in progress.
                    - Rebase recent WIP commits into a single commit with a provided message.
                    MD,
                'role' => 'Author',
                'stack' => ['Go', 'Git'],
                'status' => ProjectStatus::Live,
                'repo_url' => 'https://github.com/rileyedward/gip',
            ],
            [
                'title' => 'rbranch',
                'slug' => 'rbranch',
                'kind' => ProjectKind::Personal,
                'summary' => 'A CLI built with Go and Bubble Tea that simplifies Git branch management.',
                'body' => <<<'MD'
                    rbranch is a CLI tool built with Go and Bubble Tea designed to simplify your Git workflow. If you're tired of typing long branch names, rbranch lets you perform common branch operations with a few keystrokes.

                    ## Features

                    - Switch to another branch without typing its full name.
                    - Safely clean up unused local branches.
                    - Copy an entire branch name to your clipboard instantly.
                    MD,
                'role' => 'Author',
                'stack' => ['Go', 'Bubble Tea', 'Git'],
                'status' => ProjectStatus::Live,
                'repo_url' => 'https://github.com/rileyedward/rbranch',
            ],
            [
                'title' => 'Ripcord',
                'slug' => 'ripcord',
                'kind' => ProjectKind::Personal,
                'summary' => 'TODO: a Laravel starter kit showing how I build.',
                'stack' => ['Laravel', 'Vue'],
                'status' => ProjectStatus::InProgress,
            ],
        ];

        foreach ($projects as $index => $project) {
            Project::query()->updateOrCreate(['slug' => $project['slug']], [
                'body' => null,
                'role' => null,
                'live_url' => null,
                'repo_url' => null,
                'is_visible' => false,
                'is_featured' => false,
                ...$project,
                'sort_order' => $index,
            ]);
        }
    }
}
