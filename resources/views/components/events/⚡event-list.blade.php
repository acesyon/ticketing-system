<?php

use App\Models\Event;
use Livewire\Component;

new class extends Component
{
    public string $search = '';

    public function getEventsProperty()
    {
        return Event::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhere('location', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('start_date', 'asc')
            ->get();
    }
};
?>

<div class="w-full">
    <div class="mb-6">
        <div class="relative">
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Search events by title, description, or location..."
                class="w-full px-4 py-2.5 border border-zinc-200 dark:border-zinc-700 rounded-lg bg-white dark:bg-zinc-900 text-[#1b1b18] dark:text-white placeholder:text-zinc-400 dark:placeholder:text-zinc-500 focus:outline-none focus:ring-2 focus:ring-green-600 dark:focus:ring-green-600 focus:border-transparent transition-all"
            />
            <div class="absolute right-3 top-1/2 -translate-y-1/2 text-zinc-400 dark:text-zinc-500">
                <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </div>

    <div wire:loading class="text-center py-8 text-zinc-500 dark:text-zinc-400">
        Searching...
    </div>

    <div wire:loading.remove>
        @if ($this->events->isEmpty())
            <div class="text-center py-12">
                <p class="text-zinc-500 dark:text-zinc-400 text-lg mb-2">No events found</p>
                <p class="text-zinc-400 dark:text-zinc-500 text-sm">
                    @if ($search)
                        Try adjusting your search terms
                    @else
                        Check back soon for upcoming events
                    @endif
                </p>
            </div>
        @else
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($this->events as $event)
                    <div
                        wire:key="event-{{ $event->id }}"
                        class="p-6 rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 shadow-xs hover:shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] transition-all"
                    >
                        <div class="flex items-start justify-between mb-3">
                            <h3 class="font-semibold text-[#1b1b18] dark:text-white text-lg leading-tight">
                                {{ $event->title }}
                            </h3>
                            <span class="shrink-0 ms-2 px-2 py-1 text-xs font-medium rounded-md
                                @if($event->status === 'upcoming') bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400
                                @elseif($event->status === 'ongoing') bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400
                                @elseif($event->status === 'completed') bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-400
                                @else bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400
                                @endif">
                                {{ ucfirst($event->status) }}
                            </span>
                        </div>

                        @if ($event->description)
                            <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4 line-clamp-2">
                                {{ $event->description }}
                            </p>
                        @endif

                        <div class="space-y-2 text-sm text-zinc-500 dark:text-zinc-500">
                            <div class="flex items-center gap-2">
                                <svg class="size-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $event->start_date->format('M d, Y') }}</span>
                            </div>

                            @if ($event->start_date->format('H:i') !== '00:00')
                                <div class="flex items-center gap-2">
                                    <svg class="size-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ $event->start_date->format('g:i A') }}</span>
                                    @if ($event->end_date)
                                        <span>- {{ $event->end_date->format('g:i A') }}</span>
                                    @endif
                                </div>
                            @endif

                            @if ($event->location)
                                <div class="flex items-center gap-2">
                                    <svg class="size-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="truncate">{{ $event->location }}</span>
                                </div>
                            @endif

                            @if ($event->capacity)
                                <div class="flex items-center gap-2">
                                    <svg class="size-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span>Capacity: {{ $event->capacity }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>