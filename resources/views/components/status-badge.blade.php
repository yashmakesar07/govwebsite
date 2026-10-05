@props(['status'])

@php
    $status = strtolower($status ?? 'draft');
    $badgeClasses = match($status) {
        'active', 'published' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
        'upcoming' => 'bg-blue-100 text-blue-800 border-blue-300',
        'closing_soon' => 'bg-amber-100 text-amber-900 border-amber-300 font-bold',
        'closed', 'archived' => 'bg-slate-100 text-slate-700 border-slate-300',
        'pending_review', 'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
        'rejected' => 'bg-rose-100 text-rose-800 border-rose-300',
        'draft' => 'bg-slate-100 text-slate-600 border-slate-200',
        'scheduled' => 'bg-sky-100 text-sky-800 border-sky-300',
        'completed' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
        default => 'bg-slate-100 text-slate-700 border-slate-300',
    };

    $label = match($status) {
        'active' => __('ui.active'),
        'upcoming' => __('ui.upcoming'),
        'closing_soon' => __('ui.closing_soon'),
        'closed' => __('ui.closed'),
        'published' => 'Published',
        'draft' => 'Draft',
        'pending_review' => 'Pending Review',
        'rejected' => 'Rejected',
        'scheduled' => 'Scheduled',
        'completed' => 'Completed',
        default => ucfirst(str_replace('_', ' ', $status)),
    };
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold border {{ $badgeClasses }} tracking-wide">
    <span class="w-1.5 h-1.5 mr-1.5 rounded-full {{ in_array($status, ['active', 'published']) ? 'bg-emerald-500' : (in_array($status, ['closing_soon']) ? 'bg-amber-500 animate-pulse' : 'bg-slate-400') }}"></span>
    {{ $label }}
</span>
