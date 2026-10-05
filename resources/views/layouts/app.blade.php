<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>@yield('title', __('ui.department_name')) | {{ __('ui.state_name') }}</title>
    <meta name="description" content="@yield('meta_description', 'Official portal of the Department of Public Infrastructure, Government of Example State. Transparent governance, tenders, acts, schemes, and public disclosures.')">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph Metadata -->
    <meta property="og:title" content="@yield('title', __('ui.department_name')) | {{ __('ui.state_name') }}">
    <meta property="og:description" content="@yield('meta_description', 'Official portal of the Department of Public Infrastructure, Government of Example State.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('assets/images/emblem.svg') }}">

    <!-- Google Fonts: Inter and Noto Sans Devanagari -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Noto+Sans+Devanagari:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        :root {
            --base-font-size: 16px;
        }
        body {
            font-size: var(--base-font-size);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #F8FAFC;
            color: #10233F;
        }
        html[lang="hi"] body {
            font-family: 'Noto Sans Devanagari', 'Inter', sans-serif;
            line-height: 1.75;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-[#0A66D6] selection:text-white">
    <!-- Top Utility Bar -->
    @include('components.utility-bar')

    <!-- Main Header -->
    @include('components.header')

    <!-- Primary Navigation Bar -->
    @include('components.navigation')

    <!-- Global Breadcrumbs Slot -->
    @yield('breadcrumbs')

    <!-- Flash Notifications -->
    @if(session('success'))
        <div class="bg-emerald-50 border-b border-emerald-200 px-4 py-3 sm:px-6">
            <div class="max-w-7xl mx-auto flex items-center justify-between text-emerald-800 text-sm">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-rose-50 border-b border-rose-200 px-4 py-3 sm:px-6">
            <div class="max-w-7xl mx-auto flex items-center justify-between text-rose-800 text-sm">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Content Container -->
    <main id="main-content" class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')

    @livewireScripts

    <!-- Accessibility Font Sizer Script -->
    <script>
        let currentScale = 0;
        function adjustFontSize(delta) {
            if (delta === 0) {
                currentScale = 0;
            } else {
                currentScale = Math.max(-2, Math.min(3, currentScale + delta));
            }
            const base = 16 + (currentScale * 1.5);
            document.documentElement.style.setProperty('--base-font-size', base + 'px');
            localStorage.setItem('gov_font_scale', currentScale);
        }

        // Restore user accessibility font preference
        document.addEventListener('DOMContentLoaded', () => {
            const saved = localStorage.getItem('gov_font_scale');
            if (saved !== null) {
                adjustFontSize(parseInt(saved, 10));
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
