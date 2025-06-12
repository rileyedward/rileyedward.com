<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Riley Edward') }} - Coming Soon</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Antic+Didone&family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">

        <!-- Icons -->
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <style>
            body {
                margin: 0;
                padding: 0;
                background-color: #121212;
                color: #ffffff;
                font-family: 'JetBrains Mono', monospace;
                height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
            }

            .container {
                max-width: 800px;
                padding: 2rem;
            }

            h1 {
                font-family: 'Antic Didone', serif;
                font-size: 3rem;
                margin-bottom: 1rem;
            }

            p {
                font-size: 1.2rem;
                line-height: 1.6;
                margin-bottom: 2rem;
            }

            .logo {
                font-size: 4rem;
                margin-bottom: 2rem;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="logo">Riley Edward</div>
            <h1>Under Construction</h1>
            <p>The site is currently under development and will be launching soon.</p>
            <p>Thank you for your patience.</p>
        </div>
    </body>
</html>
