<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Title: {{ $ticket->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg space-y-6">   
                <div>
                    <strong>Description:</strong>
                    <p>{{ $ticket->description }}</p>
                </div>
                
                <div class="flex">
                    <strong>Posted at: &nbsp;</strong>
                    <p>{{ $ticket->created_at->diffForHumans() }}</p>
                </div>

                @if ($ticket->attachment)
                    <div>
                        <strong>Attachment: </strong>
                        <a href="{{ "/storage/$ticket->attachment" }}" target="_blank" class="underline">Click here</a>
                    </div>
                @endif


                <div class="flex justify-between">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('ticket.edit', $ticket->id) }}">
                            <x-primary-button>{{ __('Edit') }}</x-primary-button>
                        </a>
    
                        <form method="post" action="{{ route('ticket.destroy', $ticket->id) }}">
                            @csrf
                            @method('delete')
                                
                            <div class="flex items-center gap-4">
                                <x-danger-button>{{ __('Delete') }}</x-danger-button>
                            </div>
                        </form>
                    </div>
    
                    <div class="flex items-center gap-4">
                        <x-primary-button>Approve</x-primary-button>
    
                        <form method="post" action="{{ route('ticket.destroy', $ticket->id) }}">
                            @csrf
                            @method('delete')
                                
                            <div class="flex items-center gap-4">
                                <x-danger-button>Reject</x-danger-button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>