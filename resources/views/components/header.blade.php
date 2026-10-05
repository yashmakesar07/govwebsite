<header class="bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 sm:py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <!-- Emblem & Department Title -->
        <div class="flex items-center space-x-3.5 sm:space-x-4">
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="shrink-0 flex items-center" aria-label="Go to Homepage">
                <img src="{{ asset('assets/images/emblem.svg') }}" alt="Government Emblem Placeholder" class="w-14 h-14 sm:w-16 sm:h-16 object-contain" />
            </a>
            <div>
                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="block group">
                    <h1 class="text-lg sm:text-xl md:text-2xl font-bold text-[#062B52] leading-tight tracking-tight group-hover:text-[#0A66D6] transition">
                        {{ __('ui.department_name') }}
                    </h1>
                    <p class="text-xs sm:text-sm font-medium text-slate-600 mt-0.5">
                        {{ __('ui.state_name') }}
                        @if(app()->getLocale() === 'en')
                            <span class="text-slate-400 text-xs hidden sm:inline ml-1 font-hindi">({{ __('ui.department_name_hi') }})</span>
                        @else
                            <span class="text-slate-400 text-xs hidden sm:inline ml-1">({{ __('ui.state_name') }})</span>
                        @endif
                    </p>
                </a>
            </div>
        </div>

        <!-- Header Search Bar -->
        <div class="w-full md:w-auto md:min-w-[340px] lg:min-w-[400px]">
            <form action="{{ route('search', ['locale' => app()->getLocale()]) }}" method="GET" class="relative flex items-center" role="search">
                <label for="header-search" class="sr-only">{{ __('ui.search_placeholder') }}</label>
                <div class="relative w-full">
                    <input 
                        type="search" 
                        id="header-search" 
                        name="q" 
                        value="{{ request('q') }}"
                        placeholder="{{ __('ui.search_placeholder') }}" 
                        class="w-full pl-3.5 pr-10 py-2 border border-slate-300 rounded-md text-sm text-slate-800 placeholder-slate-400 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0A66D6] focus:border-transparent transition"
                        required
                    />
                    <button 
                        type="submit" 
                        class="absolute right-0 top-0 bottom-0 px-3 flex items-center justify-center text-slate-500 hover:text-[#0A66D6] transition"
                        aria-label="Submit search"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</header>
