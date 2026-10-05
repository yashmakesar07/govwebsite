@extends('layouts.app')

@section('title', __('ui.media_gallery'))

@section('breadcrumbs')
    <x-breadcrumbs :items="[
        ['label' => __('ui.media_gallery'), 'url' => '']
    ]" />
@endsection

@section('content')
<div class="py-8 sm:py-10 bg-slate-50 min-h-[75vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#062B52] tracking-tight">
                {{ __('ui.media_gallery') }}
            </h1>
            <p class="text-sm text-slate-600 mt-1">
                Visual documentation of public works inspections, state ceremonies, and infrastructure commissioning.
            </p>
            <div class="h-1 w-14 bg-[#0A66D6] mt-2 rounded"></div>
        </div>

        <!-- Category Filters -->
        <div class="flex items-center space-x-2 overflow-x-auto pb-3 mb-6 text-xs sm:text-sm">
            <a 
                href="{{ route('media.index', ['locale' => app()->getLocale()]) }}" 
                class="px-3.5 py-1.5 rounded-full font-medium transition {{ !request('category') || request('category') === 'all' ? 'bg-[#062B52] text-white' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-100' }}"
            >
                All Photographs
            </a>
            @foreach($categories as $cat)
                <a 
                    href="{{ route('media.index', ['locale' => app()->getLocale(), 'category' => $cat]) }}" 
                    class="px-3.5 py-1.5 rounded-full font-medium transition capitalize whitespace-nowrap {{ request('category') === $cat ? 'bg-[#062B52] text-white' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-100' }}"
                >
                    {{ $cat }}
                </a>
            @endforeach
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            @forelse($items as $item)
                <div 
                    class="group bg-white border border-slate-200 rounded-lg overflow-hidden shadow-sm cursor-pointer card-hover"
                    onclick="openLightbox('{{ asset($item->file_path) }}', '{{ addslashes($item->getTitle()) }}', '{{ addslashes($item->getCaption()) }}')"
                >
                    <div class="h-48 bg-slate-800 overflow-hidden relative">
                        <img 
                            src="{{ asset($item->file_path) }}" 
                            alt="{{ $item->getTitle() }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                        />
                        <div class="absolute top-2 right-2">
                            <span class="bg-black/60 text-white text-[10px] font-semibold uppercase px-2 py-0.5 rounded backdrop-blur-sm">
                                {{ $item->category }}
                            </span>
                        </div>
                    </div>
                    <div class="p-3.5">
                        <div class="text-[11px] text-slate-400 mb-1">
                            {{ $item->date?->format('d M Y') }}
                        </div>
                        <h2 class="text-xs font-bold text-slate-900 line-clamp-1 group-hover:text-[#0A66D6]">
                            {{ $item->getTitle() }}
                        </h2>
                        <p class="text-[11px] text-slate-500 line-clamp-2 mt-1">
                            {{ $item->getCaption() }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="col-span-full p-8 text-center bg-white rounded-lg border border-slate-200 text-slate-500 text-sm">
                    {{ __('ui.no_results') }}
                </div>
            @endforelse
        </div>

        @if($items->hasPages())
            <div class="pt-6">
                {{ $items->links() }}
            </div>
        @endif

    </div>
</div>

<!-- Lightbox Modal -->
<div id="gallery-lightbox" class="fixed inset-0 z-50 bg-black/85 hidden items-center justify-center p-4" onclick="closeLightbox(event)" role="dialog" aria-modal="true" aria-label="Photo Preview">
    <div class="max-w-3xl w-full bg-white rounded-lg overflow-hidden shadow-2xl relative" onclick="event.stopPropagation()">
        <button onclick="closeLightbox()" class="absolute top-3 right-3 text-slate-400 hover:text-slate-800 bg-white/80 rounded-full p-1.5 transition" aria-label="Close Preview">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <img id="lightbox-image" src="" alt="" class="w-full max-h-[70vh] object-contain bg-slate-950" />
        <div class="p-4 bg-white">
            <h4 id="lightbox-title" class="text-base font-bold text-slate-900"></h4>
            <p id="lightbox-caption" class="text-xs text-slate-600 mt-1"></p>
        </div>
    </div>
</div>

<script>
    function openLightbox(src, title, caption) {
        document.getElementById('lightbox-image').src = src;
        document.getElementById('lightbox-title').innerText = title;
        document.getElementById('lightbox-caption').innerText = caption;
        const modal = document.getElementById('gallery-lightbox');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    function closeLightbox() {
        const modal = document.getElementById('gallery-lightbox');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection
