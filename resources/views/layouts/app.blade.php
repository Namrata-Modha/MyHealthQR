<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'MyHealthQR') }}</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Custom Styles -->
    @yield('styles')
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom Global Styles -->
    <style>
        /* Global Reset & Fonts */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1a2a33, #0e1a22);
            color: #e8f0f2;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        header {
            width: 100%;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .logo img {
            height: 50px;
        }

        .main-content {
            width: 100%;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            margin-top: 2rem;
        }

        h1, h2, h3 {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        a {
            color: #61c7a8;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        a:hover {
            color: #4eaa8a;
        }

        .btn {
            background-color: #61c7a8;
            color: #0e1a22;
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            display: inline-block;
        }

        .btn:hover {
            background-color: #4eaa8a;
        }

        .form-group {
            margin-bottom: 1.25rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border-radius: 8px;
            border: 1px solid #ccd6dd;
            background-color: rgba(255, 255, 255, 0.15);
            color: #e8f0f2;
            font-size: 1rem;
        }

        .form-group input:focus {
            border-color: #61c7a8;
            outline: none;
            background-color: rgba(255, 255, 255, 0.2);
        }

        footer {
            margin-top: auto;
            padding: 1rem 0;
            text-align: center;
            color: #b0bec5;
            font-size: 0.9rem;
        }

        .alert {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            text-align: center;
            font-weight: 500;
        }

        .alert-success {
            background-color: rgba(97, 199, 168, 0.2);
            color: #61c7a8;
        }

        .alert-error {
            background-color: rgba(255, 82, 82, 0.15);
            color: #ff5252;
        }
    </style>
</head>
<body>
    @auth
        @if (trim($__env->yieldContent('hide_navbar')) != 'yes')
            @include('layouts.navbar') <!-- Include the navbar if not hidden and only visible for logged in user -->
        @endif
    @endauth
    <div id="app" class="main-content">
        @yield('content')
    </div>
    <footer>
        &copy; {{ date('Y') }} MyHealthQR. All Rights Reserved.
    </footer>

    <!-- jQuery & jQuery Validate -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Scripts -->
    @yield('scripts')
</body>
</html>
