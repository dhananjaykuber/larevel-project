<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Support Tickets
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

                <div class="flex justify-end">
                    <a href="{{ route("ticket.create") }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mb-4">Create New Ticket</a>
                </div>

                {{-- List of tickets --}}
                
                @forelse ($tickets as $ticket)
                    <div class="flex justify-between items-center p-4">
                        <a href="{{ route('ticket.show', $ticket->id) }}">{{ $ticket->title }}</a>
                        <p>{{ $ticket->created_at->diffForHumans() }}</p>
                    </div>
                @empty
                    <p class="mt-4">You don't have any tickets yet.</p>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>