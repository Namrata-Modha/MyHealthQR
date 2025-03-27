<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  class"dark">
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
        @include('layouts.navbar')  <!-- Navbar visible ONLY when user logged in -->
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



<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'MyHealthQR') }}</title>

    <!-- ✅ Load Tailwind CSS & JavaScript -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-brandGrayDark text-brandGrayLight min-h-screen flex flex-col justify-between">

    <!-- ✅ Navigation Bar -->
    <header class="bg-brandGrayDark text-white shadow-md py-4">
        <div class="container mx-auto flex justify-between items-center px-6">
            <!-- ✅ Logo -->
            <img src="{{ asset('images/logo.png') }}" alt="MyHealthQR Logo" class="h-12">

            <!-- ✅ Navigation Links -->
            <nav class="flex space-x-6">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-brandBlue hover:text-brandBlue-hover">Dashboard</a>
                    <a href="{{ route('user.profile') }}" class="text-brandBlue hover:text-brandBlue-hover">Profile</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700">Logout</button>
                    </form>
                @else
                    @if (Request::is('/'))  <!-- ✅ Show Login & Signup only on Welcome Page -->
                        <a href="{{ route('login') }}" class="text-brandBlue hover:text-brandBlue-hover px-3">Login</a>
                        <a href="{{ route('register') }}" class="bg-brandGreen text-white px-5 py-2 rounded-lg hover:bg-brandGreen-hover">
                            Sign Up
                        </a>
                    @endif
                @endauth
            </nav>
        </div>
    </header>

    <!-- ✅ Main Content (All Pages) -->
    <main class="flex-grow container mx-auto px-6">
        @yield('content')
    </main>

    <!-- ✅ Footer (Same for All Pages) -->
    <footer class="bg-brandGrayDark text-brandGrayLight text-center py-4 w-full mt-auto relative z-10 border-t border-brandBorder">
        <div class="container mx-auto px-6">
            <p class="text-sm">&copy; {{ date('Y') }} MyHealthQR. All Rights Reserved.</p>
            <div class="flex justify-center space-x-4 mt-2">
                <a href="{{ route('terms') }}" class="text-brandBlue hover:text-brandBlue-hover text-sm underline">Terms of Service</a>
                <span class="text-brandGrayLight">•</span>
                <a href="{{ route('privacy') }}" class="text-brandBlue hover:text-brandBlue-hover text-sm underline">Privacy Policy</a>
            </div>
        </div>
    </footer>

</body>
</html>



<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'MyHealthQR') }}</title>

    <!-- ✅ Load Tailwind CSS & JavaScript -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-brandGrayDark text-brandGrayLight min-h-screen flex flex-col justify-between">
       

    <!-- ✅ Navigation Bar -->
    <header class="bg-brandGrayDark text-white shadow-md py-4">
        <div class="container mx-auto flex justify-between items-center px-6">
            <!-- ✅ Logo -->
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                <img src="{{ asset('images/logo.png') }}" alt="MyHealthQR Logo" class="h-12 w-12 rounded-full object-cover">
                <span class="text-brandGreen text-lg font-bold">MyHealthQR</span>
            </a>

            <nav class="flex space-x-2 md:space-x-4 items-center mt-2">
                @auth
                    @php
                        $isAuthPage = Request::is('login') || Request::is('register');
                    @endphp

                    @if (! $isAuthPage)
                        <!-- ✅ Authenticated User Tabs -->
                        @php
                            $tabs = [
                                ['route' => 'dashboard', 'label' => 'Dashboard'],
                                ['route' => 'user.profile', 'label' => 'Personal Info'],
                                ['route' => 'medical.info', 'label' => 'Medical Info'],
                                ['route' => 'logs', 'label' => 'Logs']
                            ];
                        @endphp

                        @foreach ($tabs as $tab)
                            <a href="{{ route($tab['route']) }}"
                            class="px-4 py-2 rounded-full text-sm md:text-base font-semibold
                                {{ request()->routeIs($tab['route']) 
                                        ? 'bg-brandGreen text-white shadow-md' 
                                        : 'text-brandBlue hover:bg-brandBlue/10 hover:text-brandBlue-hover' }}">
                                {{ $tab['label'] }}
                            </a>
                        @endforeach

                        <!-- ✅ Logout Button -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="ml-3 px-4 py-2 rounded-full text-sm md:text-base font-semibold text-red-500 hover:text-white hover:bg-red-600 transition">
                                Logout
                            </button>
                        </form>
                    @endif
                @else
                    @if (Request::is('/'))
                        <!-- ✅ Guest on Welcome Page -->
                        <a href="{{ route('login') }}" class="text-brandBlue hover:text-brandBlue-hover px-3">Login</a>
                        <a href="{{ route('register') }}" class="bg-brandGreen text-white px-5 py-2 rounded-lg hover:bg-brandGreen-hover">
                            Sign Up
                        </a>
                    @endif
                @endauth
            </nav>

        </div>
    </header>


    <!-- ✅ Main Content (All Pages) -->
    <main class="flex-grow container mx-auto px-6">
        @yield('content')
    </main>

    <!-- ✅ Footer (Same for All Pages) -->
    <footer class="bg-brandGrayDark text-brandGrayLight text-center py-4 w-full mt-auto relative z-10 border-t border-brandBorder">
        <div class="container mx-auto px-6">
            <p class="text-sm">&copy; {{ date('Y') }} MyHealthQR. All Rights Reserved.</p>
            <div class="flex justify-center space-x-4 mt-2">
                <a href="{{ route('terms') }}" class="text-brandBlue hover:text-brandBlue-hover text-sm underline">Terms of Service</a>
                <span class="text-brandGrayLight">•</span>
                <a href="{{ route('privacy') }}" class="text-brandBlue hover:text-brandBlue-hover text-sm underline">Privacy Policy</a>
            </div>
        </div>
    </footer>

</body>
</html>
