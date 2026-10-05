<footer class="bg-[#031C36] text-slate-300 border-t-4 border-[#0A66D6] pt-12 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12 pb-10 border-b border-slate-800">
            <!-- Column 1: Identity & Description -->
            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('assets/images/emblem.svg') }}" alt="Government Emblem Placeholder" class="w-12 h-12 object-contain bg-white/10 rounded-full p-1" />
                    <div>
                        <h2 class="text-base font-bold text-white leading-tight">
                            {{ __('ui.department_name') }}
                        </h2>
                        <p class="text-xs text-slate-400 mt-0.5">
                            {{ __('ui.state_name') }}
                        </p>
                    </div>
                </div>
                <p class="text-xs text-slate-400 leading-relaxed">
                    {{ __('ui.footer_description') }}
                </p>
                <div class="pt-2">
                    <span class="inline-block text-[11px] bg-slate-800 text-slate-400 px-2.5 py-1 rounded border border-slate-700">
                        Generic Fictional Prototype &bull; STQC/WCAG Compliant Design
                    </span>
                </div>
            </div>

            <!-- Column 2: Quick Links -->
            <div>
                <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">
                    {{ __('ui.quick_links') }}
                </h3>
                <ul class="space-y-2 text-xs">
                    <li>
                        <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="hover:text-white hover:underline flex items-center space-x-1.5 transition">
                            <span class="text-[#0A66D6]">&rsaquo;</span>
                            <span>{{ __('ui.home') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about', ['locale' => app()->getLocale()]) }}" class="hover:text-white hover:underline flex items-center space-x-1.5 transition">
                            <span class="text-[#0A66D6]">&rsaquo;</span>
                            <span>{{ __('ui.about_us') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('acts.index', ['locale' => app()->getLocale()]) }}" class="hover:text-white hover:underline flex items-center space-x-1.5 transition">
                            <span class="text-[#0A66D6]">&rsaquo;</span>
                            <span>{{ __('ui.acts_rules') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('schemes.index', ['locale' => app()->getLocale()]) }}" class="hover:text-white hover:underline flex items-center space-x-1.5 transition">
                            <span class="text-[#0A66D6]">&rsaquo;</span>
                            <span>{{ __('ui.schemes') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tenders.index', ['locale' => app()->getLocale()]) }}" class="hover:text-white hover:underline flex items-center space-x-1.5 transition">
                            <span class="text-[#0A66D6]">&rsaquo;</span>
                            <span>{{ __('ui.tenders') }}</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 3: Resources -->
            <div>
                <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">
                    {{ __('ui.resources') }}
                </h3>
                <ul class="space-y-2 text-xs">
                    <li>
                        <a href="{{ route('meetings.index', ['locale' => app()->getLocale()]) }}" class="hover:text-white hover:underline flex items-center space-x-1.5 transition">
                            <span class="text-[#0A66D6]">&rsaquo;</span>
                            <span>{{ __('ui.meetings') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('financial.index', ['locale' => app()->getLocale()]) }}" class="hover:text-white hover:underline flex items-center space-x-1.5 transition">
                            <span class="text-[#0A66D6]">&rsaquo;</span>
                            <span>{{ __('ui.financial_disclosure') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('media.index', ['locale' => app()->getLocale()]) }}" class="hover:text-white hover:underline flex items-center space-x-1.5 transition">
                            <span class="text-[#0A66D6]">&rsaquo;</span>
                            <span>{{ __('ui.media') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('rti', ['locale' => app()->getLocale()]) }}" class="hover:text-white hover:underline flex items-center space-x-1.5 transition">
                            <span class="text-[#0A66D6]">&rsaquo;</span>
                            <span>{{ __('ui.rti') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="hover:text-white hover:underline flex items-center space-x-1.5 transition">
                            <span class="text-[#0A66D6]">&rsaquo;</span>
                            <span>{{ __('ui.contact') }}</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 4: Contact Information -->
            <div class="space-y-3">
                <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">
                    {{ __('ui.contact_us') }}
                </h3>
                <div class="text-xs space-y-2 text-slate-300">
                    <p class="flex items-start space-x-2">
                        <svg class="w-4 h-4 text-[#0A66D6] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Block 4, Directorate Complex, Sector 9, Capital City, Example State - 400001</span>
                    </p>
                    <p class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-[#0A66D6] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span>+91-11-2309-8800 (EPABX)</span>
                    </p>
                    <p class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-[#0A66D6] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>contact@infrastructure.example.gov.in</span>
                    </p>
                    <p class="flex items-center space-x-2 text-[11px] text-slate-400 pt-1">
                        <svg class="w-4 h-4 text-[#0A66D6] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ __('ui.office_hours') }}: Mon-Fri 09:30 - 17:30 IST</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Bottom Copyright & Mandatory Policies -->
        <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-400">
            <p>{{ __('ui.copyright') }}</p>
            <div class="flex items-center space-x-4 text-xs">
                <a href="{{ route('about', ['locale' => app()->getLocale()]) }}" class="hover:text-white transition">{{ __('ui.privacy_policy') }}</a>
                <span>&bull;</span>
                <a href="{{ route('about', ['locale' => app()->getLocale()]) }}" class="hover:text-white transition">{{ __('ui.website_policies') }}</a>
                <span>&bull;</span>
                <a href="{{ route('rti', ['locale' => app()->getLocale()]) }}" class="hover:text-white transition">{{ __('ui.accessibility') }}</a>
                <span>&bull;</span>
                <a href="{{ url('/admin') }}" class="text-amber-400 hover:text-amber-300 transition">Admin Login</a>
            </div>
        </div>
    </div>
</footer>
