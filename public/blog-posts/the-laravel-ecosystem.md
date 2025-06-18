My journey into the world of Laravel began with some client projects at my workplace, igniting a deep interest in the framework and its vibrant ecosystem. Fast forward nearly two years, and I'm still immersed in it, using Laravel for both work and personal projects. Laravel doesn't just come packed with a robust set of tools and features out of the box; its community has also cultivated an incredible ecosystem that further enhances its capabilities.

## But What is Laravel?

For those who are unaware, Laravel is an open-source PHP framework designed for building web applications. Originating from the mind of Taylor Otwell in 2011, it draws inspiration from the PHP framework Symfony. Following the MVC architectural pattern, Laravel prides itself on laying down the groundwork for developers, freeing them to focus on writing code without sweating the small stuff.

Comparable frameworks include Django in the Python world and Ruby on Rails.

## Why Should You Choose Laravel?

Despite the prevailing sentiment in programming memes, coding in PHP offers an elegant experience, especially with the language's evolution since version 5. Even amidst working with frameworks like Vue and Next.js, I often find myself relishing the process of writing PHP over JavaScript (yes, even TypeScript).

Laravel has a plethora of reasons as to why it’s worth you picking up and trying, some of which include:

- The built-in authentication and authorization with Sanctum.
- The Artisan CLI that provides a series of helpful commands for code generation and development flow.
- The Eloquent ORM for interacting with databases.
- The fully integrated cron job task scheduling with job queues and service workers.
- The real-time websocket connections with events and broadcasting.

## What About this Ecosystem?

The Laravel team takes pride in its treasure trove of first-party packages catering to every developer's need. From server management with Forge to full-text model search with Scout and complete Stripe payment integration with Cashier, there's a package for everything. These packages are meticulously maintained, and the Laravel team consistently expands the roster of first-party supported packages in their library.

## Let’s Dive into some Code

The best way to explore the vibrant ecosystem of Laravel is by diving into some code. We'll build a simple demo application that showcases multiple packages developed by the Laravel team, illustrating how seamlessly different parts of a project can be integrated.

Before diving in, here's what you'll need installed on your local machine:

- PHP
- Composer
- Node
- Docker and Docker Compose

### Project Setup and Docker

We'll kick things off by creating a new Laravel application using Composer, and navigating to the project directory.

```bash
composer create-project laravel/laravel the-laravel-ecosystem

cd the-laravel-ecosystem
```

To ensure our application runs smoothly, we'll utilize Docker containers instead of local PHP and MySQL instances. Laravel Sail, which comes bundled with Laravel, makes this process a breeze. Initialize the Docker containers with:

```bash
php artisan sail:install
```

Choose the desired services when prompted by the terminal user interface (TUI). For this demo, we'll stick with a MySQL image.

Once Sail sets up the containers, start them with:

```bash
./vendor/bin/sail up -d
```

**Note: W**ith Laravel Sail installed, all Artisan commands will be prefixed with `sail artisan ...` instead of `php artisan...`

### Bootstrap Your Project with Starter Kits

While Laravel provides basic database migrations out of the box, we can kickstart our project with additional features using supported starter kits. For this demo, we'll use Laravel Breeze. Install it with:

```bash
composer require laravel/breeze --dev
```

Once installed, scaffold the starter kit code into your project.

```bash
sail artisan breeze:install
```

Choose Vue and Inertia as the stack options during the setup process.

After scaffolding, migrate the database, install frontend dependencies, and run the development server:

```bash
sail artisan migrate:fresh

npm install
npm run dev
```

Visit **`http://localhost`** to see your application in action, courtesy of Laravel Breeze's starter kit.

### Integrating OAuth with Socialite

Suppose you want to integrate OAuth authentication, say with GitHub. Laravel Socialite makes this process a breeze. Install Socialite with:

```bash
composer require laravel/socialite
```

For GitHub OAuth integration, create an OAuth application in your GitHub account's developer settings. Store the obtained keys in your project's **`.env`** file or **`config/services.php`**.

```bash
GITHUB_CLIENT_ID=
GITHUB_CLIENT_SECRET=
GITHUB_CLIENT_REDIRECT=

```

```php
'github' => [
    'client_id' => env('GITHUB_CLIENT_ID'),
    'client_secret' => env('GITHUB_CLIENT_SECRET'),
    'redirect' => env('GITHUB_CLIENT_REDIRECT'),
]
```

Next, create endpoints to handle GitHub login and callback. Start by generating a new controller:

```powershell
sail artisan make:controller GithubAuthController

```

The **`login`** method in this controller redirects users to the GitHub login screen. This method is super simple as all it needs to do is utilize the Socialite package, set the driver got `github` , and then call the `redirect` method.

```php
use Socialite;

public function login(): RedirectResponse
{
	return Socialite::driver('github')->redirect();
}
```

The **`callback`** method handles account creation and user authentication after successful GitHub login. This method will first use the Socialite package to parse the returned payload for user information, create or update that given user in our internal MySQL database, authenticate the user with Sanctum, and then redirect them back to the dashboard.

```php
use App\\\\Models\\\\User;
use Socialite;

public function callback(): RedirectResponse
{
	$githubUser = Socialite::driver('github')->user();

	$user = User::updateOrCreate(
		['email' => $githubUser->getEmail()]
		[
			'name' => $githubUser->getName(),
			'password' => bcrypt($githubUser->getId())
		]
	);

	auth()->login($user);

	return to_route('dashboard');
}
```

Map these controller methods to endpoint URIs in **`web.php`**:

```php
use App\\\\Http\\\\Controllers\\\\GithubAuthController;

Route::get('/github/login', [GithubAuthController::class, 'login'])->name('github.login');
Route::get('/github/callback', [GithubAuthController::class, 'callback'])->name('github.callback');
```

Cache the routes with **`sail artisan route:cache`** and visit the endpoints in your application to test GitHub login.

### Stripe Integration

Imagine you want to set up a billing page for your users and offer a fantastic product for sale. Enter **Laravel Cashier** – your ticket to seamless Stripe payment integration. Get Cashier up and running with:

```php
composer require laravel/cashier
```

For Stripe integration, you'll need to create a Stripe account and obtain your secret keys along with the Price ID for the product you're selling. Add these values to your **`.env`** file:

```php
STRIPE_KEY=
STRIPE_SECRET=
STRIPE_PRICE_ID=
```

Cashier requires database migrations to work smoothly. Scaffold these migrations into your project and run them:

```php
sail artisan vendor:publish --tag="cashier-migrations"
sail artisan migrate:fresh
```

To make the most of Stripe integration, add the **`Billable`** trait provided by Cashier to your **`User`** model:

```php
use Cashier\\\\Billable;

class User extends Model
{
	use Billable;
}
```

Now, let's tweak the GitHub OAuth logic to create the retrieved user as a customer in our Stripe account if they're not already. Utilize the **`createAsStripeCustomer`** method from the **`Billable`** trait:

```php
use App\\\\Models\\\\User;
use Socialite;

public function callback(): RedirectResponse
{
	$githubUser = Socialite::driver('github')->user();

	$user = User::updateOrCreate(
		['email' => $githubUser->getEmail()]
		[
			'name' => $githubUser->getName(),
			'password' => bcrypt($githubUser->getId())
		]
	);

	if (!$user->stripe_id) {
		$user->createAsStripeCustomer();
	}

	auth()->login($user);

	return to_route('dashboard');
}
```

Let's provide users with a billing portal and a way to purchase our product. Start by creating a new controller:

```php
sail artisan make:controller BillingController
```

The **`billingPortal`** method in this controller will use Laravel Cashier to redirect the authenticated user to an external Stripe billing portal dashboard:

```php
use Illuminate\\\\Http\\\\Request;

public function billingPortal(Request $request)
{
	return $request->user()->redirectToBillingPortalUrl(route('dashboard'));
}
```

The **`checkout`** method in this controller will use Laravel Cashier, along with the Stripe Price ID, to redirect the user to an external Stripe checkout page:

```php
public function checkout()
{
	return Checkout::guest()
		->create([env('STRIPE_PRICE_ID')], [
			'success_url' => route('dashboard'),
			'cancel_url' => route('dashboard')
		]);
}
```

Map these controller methods to endpoint URIs in **`web.php`**:

```php
Route::get('/billing', [BillingController::class, 'billingPortal'])->name('billing');
Route::get('/checkout', [BillingController::class, 'checkout'])->name('checkout');
```

Cache the routes with **`sail artisan route:cache`** and visit the endpoints in your application to test the Stripe integration.

## Wrapping Things Up

In under an hour, with just a few code additions, our application boasts:

- Full-fledged authentication and authorization, complete with registration and login flows
- Secure routes, including a profile section for users to tweak their data
- Integration with GitHub OAuth for alternative login methods
- A billing portal allowing users to manage their Stripe account details
- A checkout page enabling customers to purchase our product effortlessly

This is merely scratching the surface of what the Laravel ecosystem offers. Our demo taps into just seven of the 24 packages highlighted on the official documentation website. With Laravel, the sky's the limit for what you can achieve in your projects.
