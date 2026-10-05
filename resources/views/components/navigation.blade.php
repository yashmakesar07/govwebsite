<nav class="bg-[#062B52] border-b border-[#041D38] sticky top-0 z-40 shadow-sm" aria-label="Main Navigation">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-12">
            <!-- Desktop Horizontal Navigation Links -->
            <div class="hidden lg:flex items-center space-x-1 overflow-x-auto py-1">
                @php
                    $locale = app()->getLocale();
                    $navItems = [
                        ['name' => __('ui.home'), 'route' => 'home', 'url' => route('home', ['locale' => $locale])],
                        ['name' => __('ui.about_us'), 'route' => 'about', 'url' => route('about', ['locale' => $locale])],
                        ['name' => __('ui.acts_rules'), 'route' => 'acts.*', 'url' => route('acts.index', ['locale' => $locale])],
                        ['name' => __('ui.schemes'), 'route' => 'schemes.*', 'url' => route('schemes.index', ['locale' => $locale])],
                        ['name' => __('ui.tenders'), 'route' => 'tenders.*', 'url' => route('tenders.index', ['locale' => $locale])],
                        ['name' => __('ui.meetings'), 'route' => 'meetings.*', 'url' => route('meetings.index', ['locale' => $locale])],
                        ['name' => __('ui.financial_disclosure'), 'route' => 'financial.*', 'url' => route('financial.index', ['locale' => $locale])],
                        ['name' => __('ui.media'), 'route' => 'media.*', 'url' => route('media.index', ['locale' => $locale])],
                        ['name' => __('ui.rti'), 'route' => 'rti', 'url' => route('rti', ['locale' => $locale])],
                        ['name' => __('ui.contact'), 'route' => 'contact', 'url' => route('contact', ['locale' => $locale])],
                    ];
                @endphp

                @foreach($navItems as $item)
                    @php
                        $isActive = request()->routeIs($item['route']);
                    @endphp
                    <a 
                        href="{{ $item['url'] }}" 
                        class="px-3 py-1.5 rounded text-sm font-medium transition whitespace-nowrap {{ $isActive ? 'bg-[#0A66D6] text-white shadow-sm font-semibold' : 'text-slate-200 hover:text-white hover:bg-[#0E355F]' }}"
                        {{ $isActive ? 'aria-current=page' : '' }}
                    >
                        {{ $item['name'] }}
                    </a>
                @endforeach
            </div>

            <!-- Portal Admin Badge / Direct Link -->
            <div class="hidden lg:flex items-center">
                <a 
                    href="{{ url('/admin') }}" 
                    class="inline-flex items-center space-x-1 px-2.5 py-1 text-xs font-semibold text-amber-300 bg-amber-950/40 border border-amber-500/40 rounded hover:bg-amber-900/60 hover:text-amber-200 transition"
                    title="Access Department CMS / Publishing Panel"
                >
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <span>Staff Portal</span>
                </a>
            </div>

            <!-- Mobile & Tablet Menu Toggle Button -->
            <div class="flex items-center justify-between w-full lg:hidden py-1">
                <span class="text-sm font-semibold text-white tracking-wide">
                    {{ __('ui.portal_title') }}
                </span>
                <button 
                    type="button" 
                    id="mobile-menu-toggle"
                    onclick="toggleMobileMenu()" 
                    class="p-2 rounded text-slate-300 hover:text-white hover:bg-[#0E355F] focus:outline-none focus:ring-2 focus:ring-white" 
                    aria-controls="mobile-menu-drawer" 
                    aria-expanded="false"
                    aria-label="Toggle Navigation Menu"
                >
                    <svg id="hamburger-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Full-Height Navigation Drawer -->
    <div id="mobile-menu-drawer" class="hidden lg:hidden bg-[#031C36] border-b border-slate-700 px-4 pt-2 pb-6 space-y-1 transition-all duration-200">
        @foreach($navItems as $item)
            @php
                $isActive = request()->routeIs($item['route']);
            @endphp
            <a 
                href="{{ $item['url'] }}" 
                class="block px-3 py-2.5 rounded-md text-base font-medium {{ $isActive ? 'bg-[#0A66D6] text-white font-semibold' : 'text-slate-200 hover:bg-[#0E355F] hover:text-white' }}"
                {{ $isActive ? 'aria-current=page' : '' }}
            >
                {{ $item['name'] }}
            </a>
        @endforeach

        <div class="pt-4 border-t border-slate-700/80 mt-2">
            <a 
                href="{{ url('/admin') }}" 
                class="flex items-center space-x-2 px-3 py-2 text-sm font-semibold text-amber-300 bg-amber-950/40 rounded border border-amber-600/40"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <span>Department Staff / Admin Login</span>
            </a>
        </div>
    </div>
</nav>

<script>
    function toggleMobileMenu() {
        const drawer = document.getElementById('mobile-menu-drawer');
        const hamburger = document.getElementById('hamburger-icon');
        const close = document.getElementById('close-icon');
        const button = document.getElementById('mobile-menu-toggle');

        const isExpanded = drawer.classList.contains('hidden');
        if (isExpanded) {
            drawer.classList.remove('hidden');
            hamburger.classList.add('hidden');
            close.classList.remove('hidden');
            button.setAttribute('aria-expanded', 'true');
        } else {
            drawer.classList.add('hidden');
            hamburger.classList.remove('hidden');
            close.classList.add('hidden');
            button.setAttribute('aria-expanded', 'false');
        }
    }
</script>
