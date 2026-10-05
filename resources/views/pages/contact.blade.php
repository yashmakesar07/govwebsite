@extends('layouts.app')

@section('title', __('ui.contact'))

@section('breadcrumbs')
    <x-breadcrumbs :items="[
        ['label' => __('ui.contact'), 'url' => '']
    ]" />
@endsection

@section('content')
<div class="py-8 sm:py-10 bg-slate-50 min-h-[75vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#062B52] tracking-tight">
                {{ __('ui.contact_us') }}
            </h1>
            <p class="text-sm text-slate-600 mt-1">
                Official contact channels, public facilitation desk coordinates, and grievance submission desk.
            </p>
            <div class="h-1 w-14 bg-[#0A66D6] mt-2 rounded"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Left: Contact Form (7 cols) -->
            <div class="lg:col-span-7">
                <div class="bg-white rounded-lg border border-slate-200 p-6 sm:p-8 shadow-sm">
                    <h2 class="text-lg font-bold text-[#062B52] mb-1">
                        {{ __('ui.contact_form') }}
                    </h2>
                    <p class="text-xs text-slate-500 mb-6">
                        Please provide accurate contact details for official grievance or query acknowledgment.
                    </p>

                    @if($errors->any())
                        <div class="mb-5 p-4 bg-rose-50 border border-rose-200 rounded-md text-xs text-rose-700">
                            <span class="font-bold block mb-1">Please correct the following errors:</span>
                            <ul class="list-disc list-inside space-y-0.5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit', ['locale' => app()->getLocale()]) }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label for="name" class="block text-xs font-semibold text-slate-700 mb-1">
                                {{ __('ui.name') }} <span class="text-rose-600">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                value="{{ old('name') }}" 
                                required
                                class="w-full px-3 py-2 border border-slate-300 rounded-md text-xs sm:text-sm text-slate-800 focus:ring-2 focus:ring-[#0A66D6] focus:border-transparent" 
                            />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="email" class="block text-xs font-semibold text-slate-700 mb-1">
                                    {{ __('ui.email') }} <span class="text-rose-600">*</span>
                                </label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    id="email" 
                                    value="{{ old('email') }}" 
                                    required
                                    class="w-full px-3 py-2 border border-slate-300 rounded-md text-xs sm:text-sm text-slate-800 focus:ring-2 focus:ring-[#0A66D6] focus:border-transparent" 
                                />
                            </div>

                            <div>
                                <label for="phone" class="block text-xs font-semibold text-slate-700 mb-1">
                                    {{ __('ui.phone') }}
                                </label>
                                <input 
                                    type="tel" 
                                    name="phone" 
                                    id="phone" 
                                    value="{{ old('phone') }}" 
                                    placeholder="+91-XXXXXXXXXX"
                                    class="w-full px-3 py-2 border border-slate-300 rounded-md text-xs sm:text-sm text-slate-800 focus:ring-2 focus:ring-[#0A66D6] focus:border-transparent" 
                                />
                            </div>
                        </div>

                        <div>
                            <label for="subject" class="block text-xs font-semibold text-slate-700 mb-1">
                                {{ __('ui.subject') }} <span class="text-rose-600">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="subject" 
                                id="subject" 
                                value="{{ old('subject') }}" 
                                required
                                placeholder="Brief summary of inquiry or reference number"
                                class="w-full px-3 py-2 border border-slate-300 rounded-md text-xs sm:text-sm text-slate-800 focus:ring-2 focus:ring-[#0A66D6] focus:border-transparent" 
                            />
                        </div>

                        <div>
                            <label for="message" class="block text-xs font-semibold text-slate-700 mb-1">
                                {{ __('ui.message') }} <span class="text-rose-600">*</span>
                            </label>
                            <textarea 
                                name="message" 
                                id="message" 
                                rows="5" 
                                required
                                placeholder="Detailed description of your inquiry, grievance, or RTI query..."
                                class="w-full px-3 py-2 border border-slate-300 rounded-md text-xs sm:text-sm text-slate-800 focus:ring-2 focus:ring-[#0A66D6] focus:border-transparent"
                            >{{ old('message') }}</textarea>
                        </div>

                        <div>
                            <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-[#0A66D6] hover:bg-blue-700 text-white font-semibold text-sm rounded-md shadow-sm transition">
                                {{ __('ui.submit') }} Inquiry &rarr;
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <!-- Right: Office Details & Map (5 cols) -->
            <div class="lg:col-span-5 space-y-6">
                
                <div class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm">
                    <h2 class="text-sm font-bold uppercase tracking-wider text-[#062B52] pb-3 border-b border-slate-100 mb-4">
                        Headquarters Information
                    </h2>

                    <div class="space-y-4 text-xs text-slate-700">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-[#0A66D6] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <div>
                                <span class="font-bold text-slate-900 block">{{ __('ui.office_address') }}</span>
                                <span>Department of Public Infrastructure<br>Block 4, Directorate Complex, Sector 9<br>Capital City, Example State - 400001</span>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-[#0A66D6] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <div>
                                <span class="font-bold text-slate-900 block">{{ __('ui.phone') }}</span>
                                <span>+91-11-2309-8800 (General EPABX)</span><br>
                                <span>+91-11-2309-8801 (Control Room)</span>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-[#0A66D6] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <div>
                                <span class="font-bold text-slate-900 block">{{ __('ui.email') }}</span>
                                <span>contact@infrastructure.example.gov.in</span><br>
                                <span>grievance@infrastructure.example.gov.in</span>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-[#0A66D6] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <span class="font-bold text-slate-900 block">{{ __('ui.office_hours') }}</span>
                                <span>Monday to Friday: 09:30 AM to 05:30 PM IST</span><br>
                                <span class="text-slate-400">Closed on Second Saturdays, Sundays & Gazetted Holidays</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Office Location Map Placeholder -->
                <div class="bg-white rounded-lg border border-slate-200 overflow-hidden shadow-sm">
                    <div class="p-3 bg-slate-100 border-b border-slate-200 flex items-center justify-between text-xs">
                        <span class="font-semibold text-slate-700">Office Location Map</span>
                        <span class="text-slate-500 font-mono text-[11px]">28.6139° N, 77.2090° E</span>
                    </div>
                    <!-- Stylized Map Placeholder with SVG Pin -->
                    <div class="h-56 bg-slate-200 relative flex items-center justify-center overflow-hidden">
                        <!-- Grid Lines -->
                        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#062B52 1px, transparent 1px); background-size: 16px 16px;"></div>
                        <!-- Road Pathways -->
                        <svg class="absolute inset-0 w-full h-full opacity-40" xmlns="http://www.w3.org/2000/svg">
                            <line x1="0" y1="80" x2="400" y2="120" stroke="#94A3B8" stroke-width="8"/>
                            <line x1="120" y1="0" x2="220" y2="250" stroke="#94A3B8" stroke-width="6"/>
                            <line x1="80" y1="200" x2="350" y2="50" stroke="#CBD5E1" stroke-width="4"/>
                        </svg>
                        <!-- Center Location Pin -->
                        <div class="relative z-10 text-center flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full bg-rose-600 text-white flex items-center justify-center shadow-lg animate-bounce">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <span class="mt-2 text-xs font-bold text-[#062B52] bg-white/95 px-2.5 py-1 rounded shadow-sm border border-slate-200">
                                Directorate Complex, Sector 9
                            </span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
