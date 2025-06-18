# Getting Started with Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling.

## Installation

Before you start, make sure you have PHP and Composer installed on your machine. Then, you can install Laravel by running:

```bash
composer create-project laravel/laravel example-app
cd example-app
php artisan serve
```

## Key Features

### Eloquent ORM

Laravel includes Eloquent, an object-relational mapper (ORM) that makes it enjoyable to interact with your database:

```php
$users = App\Models\User::where('active', 1)
                       ->orderBy('name', 'desc')
                       ->take(10)
                       ->get();
```

### Blade Templating

Blade is the simple, yet powerful templating engine provided with Laravel:

```php
@foreach ($users as $user)
    <p>This is user {{ $user->id }}</p>
@endforeach
```

### Routing

Laravel makes routing a breeze:

```php
Route::get('/posts/{post}', function (Post $post) {
    return view('post.show', ['post' => $post]);
});
```

## Conclusion

Laravel provides the tools needed for large, robust applications as well as simple JSON APIs. Give it a try for your next project!
