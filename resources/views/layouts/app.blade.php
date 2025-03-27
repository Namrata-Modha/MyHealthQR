<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'MyHealthQR') }}</title>

    <!-- ✅ Load jQuery FIRST -->
    <!-- @include('partials.validation-scripts') -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

    <!-- ✅ Load Tailwind + Your Vite Files -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<style>
    .tooltip {
        z-index: 9999 !important;
    }
</style>

<!-- <body class="bg-brandGrayDark text-brandGrayLight min-h-screen flex flex-col justify-between relative z-10">-->

<body class="bg-brandGrayDark text-brandGrayLight min-h-screen flex flex-col relative z-10">

    <!-- ✅ Background Image (shared across all pages) -->
    <div class="absolute top-0 left-0 w-full h-full bg-cover bg-center bg-no-repeat z-0" 
        style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
        <div class="absolute inset-0 bg-brandGrayDark/70"></div>  <!-- Dark overlay -->
    </div>

    <!-- ✅ Navigation Bar -->
    <header class="relative z-10 bg-brandGrayDark text-white shadow-md py-4">
        <div class="container mx-auto flex justify-between items-center px-6">
            
            <!-- ✅ Logo -->
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                <img src="{{ asset('images/logo.png') }}" alt="MyHealthQR Logo" class="h-10 w-10 rounded-full object-cover">
                <span class="text-brandGreen text-lg font-bold">MyHealthQR</span>
            </a>

            <!-- ✅ Hamburger Menu (Mobile) -->
            <button id="nav-toggle" class="md:hidden block text-white focus:outline-none">
                <i class="fas fa-bars text-xl"></i> <!-- FontAwesome Icon -->
            </button>

            <!-- ✅ Navigation Links (Hidden on Mobile) -->
            <nav id="nav-menu" class="hidden md:flex md:space-x-4 items-center">
                @auth
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
                        class="px-6 py-2 rounded-full text-sm md:text-base font-semibold transition
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

        <!-- ✅ Mobile Navigation (Dropdown) -->
        <div id="mobile-menu" class="md:hidden hidden bg-brandGrayMedium text-white px-6 py-4">
            @auth
                @foreach ($tabs as $tab)
                    <a href="{{ route($tab['route']) }}"
                    class="block py-2 text-sm font-semibold {{ request()->routeIs($tab['route']) ? 'text-brandGreen' : 'text-white hover:text-brandBlue-hover' }}">
                        {{ $tab['label'] }}
                    </a>
                @endforeach

                <!-- ✅ Mobile Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="w-full text-left py-2 text-red-500 hover:text-white hover:bg-red-600 transition">
                        Logout
                    </button>
                </form>

            @else
                @if (Request::is('/'))
                    <a href="{{ route('login') }}" class="block py-2 text-white hover:text-brandBlue-hover">Login</a>
                    <a href="{{ route('register') }}" class="block py-2 text-white hover:text-brandGreen-hover">Sign Up</a>
                @endif
            @endauth
        </div>
    </header>



    <!-- ✅ Main Content (All Pages) -->
    <main class="flex-grow container mx-auto px-6 relative z-10">
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


@yield('scripts')

</body>
</html>
