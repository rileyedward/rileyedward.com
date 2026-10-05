<?php

namespace Database\Seeders;

use App\Enums\ProjectKind;
use App\Enums\ProjectStatus;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Seed client work, then projects from Riley's public GitHub repositories
     * (github.com/rileyedward), newest first. Copy comes from each README.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Dandelines Design',
                'slug' => 'dandelines-design',
                'kind' => ProjectKind::Client,
                'summary' => 'Website, shop and admin panel for an event planning, floral and artwork studio in Independence, Missouri.',
                'body' => <<<'MD'
                    Dandelines Design is the website for an event planning, floral and original artwork studio in Independence, Missouri. Visitors can learn about the studio and its services, read the blog, subscribe to the newsletter, send a message or request a quote, and buy handmade textiles, prints and mixed media pieces from the shop.

                    Behind the scenes, a custom admin panel runs the business side of the site.

                    ## What it handles

                    - **Shop and checkout**: products and stock, with payments through Stripe.
                    - **Orders**: from payment through to printed shipping labels.
                    - **Inquiries**: the contact inbox and quote requests, with email replies.
                    - **Content**: blog posts and the featured read, plus testimonials.
                    - **Newsletter**: subscribers and email campaigns.
                    MD,
                'stack' => ['Laravel', 'PHP', 'Vue', 'Inertia', 'Tailwind', 'Stripe', 'EasyPost', 'Resend'],
                'status' => ProjectStatus::Live,
                'live_url' => 'https://dandelinesdesign.com',
                'is_featured' => true,
            ],
            [
                'title' => "Pick'ems",
                'slug' => 'pickems',
                'summary' => "NFL pick'ems for friends: weekly picks, placement points and a season leaderboard.",
                'body' => <<<'MD'
                    Pick'ems is a web application for running a weekly NFL pick'ems league with friends. Players register their own accounts, pick a winner for every game before the first kickoff, and earn placement points each week that roll up into a season leaderboard.

                    The season's teams and schedule are pulled from ESPN, and the app runs on Laravel Cloud with profile photos stored on object storage.
                    MD,
                'stack' => ['Laravel', 'PHP', 'Vue', 'TypeScript', 'Inertia', 'Pest'],
                'status' => ProjectStatus::Live,
                'repo_url' => 'https://github.com/rileyedward/pickems',
                'is_featured' => true,
            ],
            [
                'title' => 'Portal Atlas',
                'slug' => 'portal-atlas',
                'summary' => 'An unofficial, community-made interactive map and raid companion for Active Matter.',
                'body' => <<<'MD'
                    Portal Atlas is a web application for exploring Active Matter's maps. Players can find extraction points, loot and objectives, look up items and whether to keep them, and plan raid routes.

                    Every data point carries its source, a confidence score and the game version it was verified for, and anyone can report an entry that is wrong.

                    It runs on Laravel Cloud with PostgreSQL, with admin-uploaded map images on object storage. Portal Atlas is not produced, approved or endorsed by Gaijin Entertainment or Matter Team.
                    MD,
                'stack' => ['Laravel', 'PHP', 'Vue', 'TypeScript', 'PostgreSQL', 'Python'],
                'status' => ProjectStatus::Live,
                'live_url' => 'https://atlas.flashy.gg',
                'repo_url' => 'https://github.com/rileyedward/portal-atlas',
                'is_featured' => true,
            ],
            [
                'title' => 'Ocarina Practice',
                'slug' => 'ocarina-practice',
                'summary' => 'Fingering charts and phrase-by-phrase practice for the ocarina, running entirely in the browser.',
                'body' => <<<'MD'
                    Ocarina Practice is an application for learning the ocarina: the 12-hole alto C by default, with 6-hole and 4-hole pendants and the soprano and bass alongside it. It shows the fingering for every note an instrument can play, pre-built scale runs for warm-ups, and songs built out of short phrases, a few phrases at a time, while you hold the instrument.

                    Everything runs in the browser as a client-only SPA, with no backend, no database and no account.

                    ## Features

                    - **Complete fingering chart**: all 21 notes from A4 to F6, fully chromatic.
                    - **Five instruments**: 12-hole alto, soprano and bass C, plus 6-hole and 4-hole pendants.
                    - **Change hints**: each card marks the holes that lift and press against the note before it.
                    - **Phrase-based practice**: songs are ordered lists of short phrases rather than a wall of notes.
                    - **Hands-free turning**: a wake lock keeps the screen on, and pages turn on a tap or a timer.
                    - **Staff notation**: the same phrase on a treble staff, hand-drawn in SVG.
                    MD,
                'stack' => ['Nuxt', 'Vue', 'TypeScript', 'Tailwind', 'Vitest'],
                'status' => ProjectStatus::InProgress,
                'repo_url' => 'https://github.com/rileyedward/ocarina-of-learning',
            ],
            [
                'title' => 'Parity',
                'slug' => 'parity',
                'summary' => "Visual differences for everything that isn't text: compare images, SVG, PDF and DXF side by side.",
                'body' => <<<'MD'
                    Parity is a local application for comparing two renderings of the same thing. Point it at two files, or two entire folders, and view them side by side, overlaid, wiped between, or blinked in place, with pan and zoom locked together.

                    Checking that two versions of a drawing match is tedious work. Parity puts both renderings in one shared pixel space so differences are visible directly rather than inferred, and pairs entire folders automatically.

                    ## Features

                    - **File or folder comparison**: pair every file in two folders by path and basename.
                    - **Structure validation**: orphaned files, missing folders and basename collisions are reported up front.
                    - **Four compare modes**: side by side, overlay, swipe and blink, sharing one pan/zoom state.
                    - **Multi-format**: raster images, SVG, PDF and DXF in any combination.
                    - **Alignment tools**: a per-edge pixel readout of how far the two sides differ.
                    MD,
                'stack' => ['Vue', 'JavaScript', 'Vite'],
                'status' => ProjectStatus::InProgress,
                'repo_url' => 'https://github.com/rileyedward/parity',
            ],
            [
                'title' => 'Cadence',
                'slug' => 'cadence',
                'summary' => 'A life-structure compiler that turns flexible intentions into an adaptive daily timeline.',
                'body' => <<<'MD'
                    Cadence turns flexible human intention into an adaptive daily timeline. Instead of scheduling individual tasks, you define recurring routine templates made of time blocks, choose each day what state you'll be in for each block, and let Cadence compile those decisions into a concrete, ordered timeline, with buffers and transitions, that reflows live as your day changes.

                    It ships as a mobile-first, installable PWA.

                    ## Features

                    - **Routine templates**: reusable weekly structures built from ordered time blocks.
                    - **Daily intents**: pick the behavioral state for each block, like recovery, deep work or movement.
                    - **Deterministic compiler**: a PHP engine compiles decisions into a versioned timeline; the server is the single source of truth.
                    - **Live adjustments**: edit your day as it happens and the rest of the timeline reflows.
                    - **Check-ins and history**: log started, completed or skipped against each block.
                    - **Google Calendar sync**: optional two-way calendar integration.
                    MD,
                'stack' => ['Laravel', 'PHP', 'Vue', 'TypeScript', 'Tailwind', 'Inertia'],
                'status' => ProjectStatus::InProgress,
                'repo_url' => 'https://github.com/rileyedward/cadence',
                'is_featured' => true,
            ],
            [
                'title' => 'MLB Stats Lab',
                'slug' => 'mlb-stats-lab',
                'summary' => 'An MLB Statcast analytics playground: pitch-level data, Jupyter notebooks and team-themed PDF reports.',
                'body' => <<<'MD'
                    A personal MLB Statcast analytics playground. It pulls pitch-level data via [pybaseball](https://github.com/jldbc/pybaseball), explores it in JupyterLab, and renders polished team-themed PDF reports.

                    A small CLI scaffolds notebooks and renders reports from templates, and notebook templates are authored as plain Python files paired to notebooks with jupytext.
                    MD,
                'stack' => ['Python', 'Jupyter', 'pybaseball', 'WeasyPrint'],
                'status' => ProjectStatus::InProgress,
                'repo_url' => 'https://github.com/rileyedward/mlb-stats-lab',
            ],
            [
                'title' => 'Cube Timer',
                'slug' => 'cube-timer',
                'summary' => 'A tiny static site with a Start Timer button. It does not start a timer.',
                'body' => <<<'MD'
                    A tiny static site hosted on Cloudflare Pages. Tapping **Start Timer** plays a full-screen video with sound.

                    Built with love. Never gonna let your solve down.
                    MD,
                'stack' => ['HTML', 'Cloudflare Pages'],
                'status' => ProjectStatus::Live,
                'live_url' => 'https://timer.rileyedward.com',
                'repo_url' => 'https://github.com/rileyedward/cube-timer',
                'is_visible' => false,
            ],
            [
                'title' => 'Straftat Score Keeper',
                'slug' => 'straftat-score-keeper',
                'summary' => 'A companion app for tracking score across game-night tournaments of the arena shooter Straftat.',
                'body' => <<<'MD'
                    Straftat Score Keeper fills the gap left by the game's lack of a built-in tournament mode. A host logs matches across 1v1, 2v2 and FFA throughout the night, the app computes a unified leaderboard that fairly weighs all three modes, and it crowns a champion (with a few bonus stars) when the night wraps up. Players persist across sessions so stats build up over time.

                    ## Features

                    - **Tournament sessions**: one active tournament per game night, locked when it ends.
                    - **Match wizard**: mode, players, score; FFA placements derive automatically with proper tie handling.
                    - **Combined leaderboard**: mode-aware scoring, filterable by overall, 1v1, 2v2 or FFA.
                    - **Bonus stars**: eight Mario Party-style awards computed at the end of each tournament.
                    - **Player roster**: profiles with image upload and cross-tournament stats.
                    MD,
                'stack' => ['Laravel', 'PHP', 'Vue', 'TypeScript', 'Tailwind', 'PostgreSQL', 'Pest'],
                'status' => ProjectStatus::InProgress,
                'repo_url' => 'https://github.com/rileyedward/straftat-score-keeper',
            ],
            [
                'title' => 'Audio Waveform Visualizer',
                'slug' => 'audio-waveform-visualizer',
                'summary' => 'Render YouTube-ready visualizer videos for DJ mixes, with local track identification and chapters.',
                'body' => <<<'MD'
                    Audio Waveform Visualizer turns DJ mixes into uploadable visualizer videos. Feed it a WAV or MP3, pick a visual style and color palette, and it produces a 1080p MP4 with a reactive waveform, your artist and mix title, an optional logo, and a progress bar.

                    Point it at your crate of source tracks and it fingerprints them, identifies which track plays when in the mix, overlays the now-playing track on the video, writes a timestamped YouTube tracklist and embeds chapter markers. Everything runs locally, with no external APIs.

                    ## Features

                    - **Four visualizer styles**: radial, bars, mirrored waveform and particle bloom.
                    - **Six color palettes**, editable via JSON.
                    - **Local track fingerprinting** into a SQLite database.
                    - **Dynamic on-screen tracklist** with a "NEXT:" preview between tracks.
                    - **YouTube tracklist and MP4 chapters**.
                    - **Local web UI** for picking a mix, previewing styles and watching render progress.
                    MD,
                'stack' => ['Python', 'FFmpeg', 'SQLite', 'JavaScript'],
                'status' => ProjectStatus::InProgress,
                'repo_url' => 'https://github.com/rileyedward/audio-waveform-visualizer',
            ],
            [
                'title' => 'Corvesive',
                'slug' => 'corvesive',
                'summary' => 'Simplify your budgeting: track income from pay stubs, record expenses and see what is left.',
                'body' => <<<'MD'
                    Corvesive is an online application designed to simplify budgeting. Track your income by uploading pay stubs, record your monthly expenses, and monitor where your money is going and how much you have left.

                    ## Features

                    - **Income manager**: upload pay stubs and keep a record of all your income sources.
                    - **Expense manager**: record monthly expenses and categorize them for easy tracking.
                    - **Spending insights**: visualize where your money is going to make informed budgeting decisions.
                    MD,
                'stack' => ['Laravel', 'PHP', 'Vue', 'JavaScript'],
                'status' => ProjectStatus::Archived,
                'repo_url' => 'https://github.com/rileyedward/corvesive',
            ],
            [
                'title' => 'Applicy',
                'slug' => 'applicy',
                'summary' => 'Streamline your job application journey with application tracking and AI help on resumes and cover letters.',
                'body' => <<<'MD'
                    Applicy is an online platform that simplifies the job application process. Create a profile to track all your job applications and monitor their progress in real time.

                    ## Features

                    - **Resumes**: store your resumes and get AI recommendations based on the job you're applying for.
                    - **Cover letters**: store your cover letters and have the AI assistant tailor versions for each job.
                    MD,
                'stack' => ['Laravel', 'PHP', 'Vue', 'JavaScript'],
                'status' => ProjectStatus::Archived,
                'repo_url' => 'https://github.com/rileyedward/applicy',
            ],
            [
                'title' => 'AirQueue',
                'slug' => 'airqueue',
                'summary' => 'Share music with your friends using Spotify-powered Live Sessions.',
                'body' => <<<'MD'
                    AirQueue enhances music sharing with friends through interactive Live Sessions, integrating with the Spotify Developer API to search for songs and interact with each listener's Spotify account.

                    ## Features

                    - **Spotify integration**: connect your AirQueue account with Spotify.
                    - **Bands**: join a group of like-minded music friends.
                    - **Live sessions**: host or join a session and request songs together.
                    - **Song requests**: approve incoming requests to add them to your live Spotify queue.
                    MD,
                'stack' => ['Laravel', 'PHP', 'Vue', 'TypeScript', 'Spotify API'],
                'status' => ProjectStatus::Archived,
                'repo_url' => 'https://github.com/rileyedward/airqueue',
            ],
            [
                'title' => 'rbranch',
                'slug' => 'rbranch',
                'summary' => 'A CLI tool built with Go and Bubble Tea to simplify Git branches.',
                'body' => <<<'MD'
                    rbranch is a CLI tool built with Go and Bubble Tea designed to simplify your Git workflow. If you're tired of typing long and cumbersome branch names, rbranch lets you perform common branch operations with a few keystrokes.

                    ## Features

                    - **Checkout branches**: switch to another branch without typing its full name.
                    - **Delete branches**: safely clean up unused local branches.
                    - **Copy branch names**: copy an entire branch name to your clipboard.
                    MD,
                'stack' => ['Go', 'Bubble Tea', 'Git'],
                'status' => ProjectStatus::Archived,
                'repo_url' => 'https://github.com/rileyedward/rbranch',
            ],
            [
                'title' => 'gip',
                'slug' => 'gip',
                'summary' => 'A lightweight CLI tool for work-in-progress commits.',
                'body' => <<<'MD'
                    gip is a lightweight command-line tool designed to streamline work-in-progress (WIP) commits. If you often juggle micro-commits during development, gip helps you manage them without complicating your Git workflow.

                    ## Features

                    - **WIP commit**: quickly commit all the work you currently have in progress.
                    - **WIP rebasing**: rebase recent WIP commits into a single commit with a provided message.
                    MD,
                'stack' => ['Go', 'Git'],
                'status' => ProjectStatus::Archived,
                'repo_url' => 'https://github.com/rileyedward/gip',
            ],
        ];

        foreach ($projects as $index => $project) {
            Project::query()->updateOrCreate(['slug' => $project['slug']], [
                'kind' => ProjectKind::Personal,
                'role' => null,
                'live_url' => null,
                'is_visible' => true,
                'is_featured' => false,
                ...$project,
                'sort_order' => $index,
            ]);
        }
    }
}
