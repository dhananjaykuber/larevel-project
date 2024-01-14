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


                <div class="flex justify-between items-center">
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
                    
                    <p class="uppercase border text-sm p-1 px-2 rounded-full">{{ $ticket->status }}</p>
                    
                    @if (auth()->user()->isAdmin)
                        <div class="flex items-center gap-4">

                            <form method="post" action="{{ route('ticket.update', $ticket->id) }}">
                                @csrf
                                @method('patch')
                                
                                <input type="hidden" name="status" value="resolved">
                                <x-primary-button>Resolve</x-primary-button>
                            </form>
                            
                            <form method="post" action="{{ route('ticket.update', $ticket->id) }}">
                                @csrf
                                @method('patch')
                                
                                <input type="hidden" name="status" value="rejected">
                                <x-danger-button>Reject</x-danger-button>
                            </form>
                        </div>
                    @endif
                </div>


            </div>
        </div>
    </div>


    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg space-y-6"> 
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Replies
                </h2>  
                
                <div>
                    <form method="post" action="{{ route('ticket.replies.store', $ticket->id) }}">
                        @csrf

                        <div>
                            <x-input-label for="body" value="Reply" />
                            <x-textarea name="body" id="body"/>
                            <x-input-error class="mt-2" :messages="$errors->get('body')" />
                        </div>
    
                        <div class="flex items-center gap-4 mt-1">
                            <x-primary-button>Post</x-primary-button>
                        </div>
                    </form>
                </div>

                <div>
                    @forelse ($replies as $reply)
                        <div class="flex flex-col p-4 border rounded-lg mt-2">
                            <strong>{{ $reply->body }}</strong>
                            <div class="flex items-center justify-between mt-1">
                                <p class="text-red-700 text-sm capitalize">
                                    <strong>By:</strong> 
                                    @if ($reply->user->isAdmin)
                                        Admin
                                    @else
                                        {{ $reply->user->name }}
                                    @endif
                                </p>
                                <p class="text-xs border py-1 px-3 rounded-full">{{ $reply->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="mt-4">No replies.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>