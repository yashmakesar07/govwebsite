@props(['items' => []])

<nav aria-label="Breadcrumb" class="bg-slate-100 border-b border-slate-200 py-2.5 px-4 sm:px-6 lg:px-8 text-xs">
    <div class="max-w-7xl mx-auto flex items-center space-x-2 text-slate-600 flex-wrap">
        <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="hover:text-[#0A66D6] flex items-center space-x-1 font-medium">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <span>{{ __('ui.home') }}</span>
        </a>

        @foreach($items as $item)
            <span class="text-slate-400">/</span>
            @if(!empty($item['url']) && !$loop->last)
                <a href="{{ $item['url'] }}" class="hover:text-[#0A66D6] font-medium">
                    {{ $item['label'] }}
                </a>
            @else
                <span class="text-slate-800 font-semibold" aria-current="page">
                    {{ $item['label'] }}
                </span>
            @endif
        @endforeach
    </div>
</nav>
