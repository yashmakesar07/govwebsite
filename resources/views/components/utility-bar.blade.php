<div class="bg-[#031C36] text-[#E2E8F0] border-b border-[#0E355F] text-xs py-1.5 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
        <!-- Left: Official National & State Identity -->
        <div class="flex items-center space-x-3">
            <span class="font-medium tracking-wide text-slate-300">
                {{ __('ui.bharat_sarkar') }}
            </span>
            <span class="text-slate-600">|</span>
            <span class="font-medium text-slate-300">
                {{ __('ui.government_of') }}
            </span>
        </div>

        <!-- Right: Accessibility & Language Switcher -->
        <div class="flex items-center space-x-4">
            <!-- Skip to content link for screen readers & keyboard nav -->
            <a href="#main-content" class="skip-link sr-only focus:not-sr-only focus:inline-block focus:bg-amber-600 focus:text-white focus:px-3 focus:py-1 focus:rounded text-xs font-semibold">
                {{ __('ui.skip_to_content') }}
            </a>

            <!-- Font Resizer -->
            <div class="flex items-center space-x-1 border-r border-slate-700 pr-3" aria-label="Font Size Controls">
                <span class="text-[11px] text-slate-400 mr-1 hidden sm:inline">{{ __('ui.accessibility') }}:</span>
                <button type="button" onclick="adjustFontSize(-1)" class="px-1.5 py-0.5 rounded text-xs font-bold hover:bg-[#0E355F] text-slate-300 transition" title="Decrease Font Size" aria-label="Decrease Font Size">A-</button>
                <button type="button" onclick="adjustFontSize(0)" class="px-1.5 py-0.5 rounded text-xs font-bold hover:bg-[#0E355F] text-slate-300 transition" title="Reset Font Size" aria-label="Reset Font Size">A</button>
                <button type="button" onclick="adjustFontSize(1)" class="px-1.5 py-0.5 rounded text-xs font-bold hover:bg-[#0E355F] text-slate-300 transition" title="Increase Font Size" aria-label="Increase Font Size">A+</button>
            </div>

            <!-- Language Switcher -->
            <div class="flex items-center space-x-1.5 font-medium">
                @if(app()->getLocale() === 'en')
                    <span class="text-white font-semibold underline decoration-2 underline-offset-4">English</span>
                    <span class="text-slate-600">|</span>
                    <a href="{{ \App\Support\LocaleHelper::switchUrl('hi') }}" class="text-slate-300 hover:text-white transition" hreflang="hi">
                        हिन्दी
                    </a>
                @else
                    <a href="{{ \App\Support\LocaleHelper::switchUrl('en') }}" class="text-slate-300 hover:text-white transition" hreflang="en">
                        English
                    </a>
                    <span class="text-slate-600">|</span>
                    <span class="text-white font-semibold underline decoration-2 underline-offset-4">हिन्दी</span>
                @endif
            </div>
        </div>
    </div>
</div>
